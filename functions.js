function getCookie(name) {
    var cookieValue = null;
    if (document.cookie && document.cookie !== '') {
        var cookies = document.cookie.split(';');
        for (var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i].trim();

            // Does this cookie string begin with the name we want?
            if (cookie.substring(0, name.length + 1) === (name + '=')) {
                cookieValue = decodeURIComponent(cookie.substring(name.length + 1));

                break;
            }
        }
    }
    return cookieValue;
}

function setCookie(name, value, expires_seconds) {
    var date = new Date();
    date.setTime(date.getTime() + (expires_seconds * 1000));
    var expires = "expires=" + date.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
}

function deleteCookie(name) {
    document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}


function crearEvento(nombreEvento, descripcion, inicio, fin, ubicacion) {
    // Obtener la zona horaria del usuario
    const zonaHorariaUsuario = Intl.DateTimeFormat().resolvedOptions().timeZone;

    // Crear el objeto de evento
    const evento = {
        summary: nombreEvento,
        description: descripcion,
        start: {
            dateTime: new Date(inicio.anio, inicio.mes - 1, inicio.dia, inicio.hora, inicio.minuto, inicio.segundo),
            timeZone: zonaHorariaUsuario,
        },
        end: {
            dateTime: new Date(fin.anio, fin.mes - 1, fin.dia, fin.hora, fin.minuto, fin.segundo),
            timeZone: zonaHorariaUsuario,
        },
        location: ubicacion, // Agregar la ubicación
    };

    return JSON.stringify(evento);
}

function convertirFechaHora(fechaHoraString) {
    // Dividir la cadena en fecha y hora
    const [fechaParte, horaParte] = fechaHoraString.split(' ');

    // Dividir la parte de la fecha en mes, día y año
    const [mes, dia, anio] = fechaParte.split('/');

    // Dividir la parte de la hora en hora y minuto
    const [hora, minuto] = horaParte.split(':');

    // Crear un objeto de fecha
    const fecha = {
        anio: parseInt(anio, 10),
        mes: parseInt(mes, 10),
        dia: parseInt(dia, 10),
        hora: parseInt(hora, 10),
        minuto: parseInt(minuto, 10),
        segundo: 0,
    };

    return fecha;
}


let calendarId = "";
async function createCalendarAndEvents(title, description, events) {
    const url = "https://www.googleapis.com/calendar/v3/calendars";
    const token = getCookie("token_type") + " " + getCookie("token");

    const data = {
        "summary": title,
        "description": description,
    };

    fetch(url, {
        method: "POST",
        headers: {
            "Authorization": token,
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(data => {
            let calendarId = data.id;

            for (let i = 0; i < events.length; i++) {
                subitEvento(calendarId, events[i]);
            }
        })
        .catch(error => console.log(error));
}


function subitEvento(calendarId, event) {
    const url = "https://www.googleapis.com/calendar/v3/calendars/"+ calendarId +"/events";
    const token = getCookie("token_type") + " " + getCookie("token");

    fetch(url, {
        method: "POST",
        headers: {
            "Authorization": token,
            "Content-Type": "application/json"
        },
        body: event
    })
        .then(response => response.json())
        .then(data => console.log(data))
        .catch(error => console.log(error));
}


function readSchedule() {
    const schedule = document.getElementById("schedule").value;
    let jsonData = {};
    //to json
    try {
        jsonData = JSON.parse(schedule);
    } catch (error) {
        alert("Invalid JSON");
        return [];
    }

    //check if valir (should be a list)
    if (!Array.isArray(jsonData)) {
        alert("Invalid JSON");
        return [];
    }

    //check if valid (should be a list of objects with the same keys)
    const keys = Object.keys(jsonData[0]);
    for (let i = 0; i < jsonData.length; i++) {
        const element = jsonData[i];
        if (Object.keys(element).length != keys.length) {
            alert("Invalid JSON");
            return [];
        }
    }

    /*{
        "title": "Cloud Computing",
        "start": "08/14/2023 08:00",
        "end": "08/14/2023 09:00",
        "hours": 1,
        "classRoom": "A701(45)",
        "codeCourse": "CS2032",
        "nameArea": "Departamento de Computer Science",
        "nameProgram": "Carreras de Pregrado",
        "section": "2",
        "sesion": "Teoría 2.00",
        "codeTeacher": 71526,
        "nameTeacher": "Colchado Ruíz, Geraldo ",
        "day": 1691989200000,
        "startHour": "08:00",
        "endHour": "09:00",
        "nameType": "Programada",
        "modality": "Presencial",
        "tipoDocente": "D",
        "asistenteEnsenanza": null
    },*/

    //check if valid should have keys (follow the example)
    const validKeys = ["title", "start", "end", "hours", "section", "sesion", "nameTeacher", "modality"];
    for (let i = 0; i < validKeys.length; i++) {
        const key = validKeys[i];
        if (!keys.includes(key)) {
            alert("Invalid JSON");
            return [];
        }
    }

    return jsonData;
}

function createEvents(eventos){
    eventos_out = [];
    for (let i = 0; i < eventos.length; i++) {
        const title = eventos[i].title;
        const inicio = convertirFechaHora(eventos[i].start);
        const fin = convertirFechaHora(eventos[i].end);
        const descripcion = eventos[i].modality + ". Profesor: " + eventos[i].nameTeacher;
        const lugar = eventos[i].modality == "Presencial" ? eventos[i].classRoom : "Virtual";

        const event = crearEvento(title, descripcion, inicio, fin, lugar);
        eventos_out.push(event);
    }
    return eventos_out;
}
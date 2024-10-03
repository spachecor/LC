$(document).ready(function () {
    //comprobamos si hay alumnos ya en el localStorage
    if (!localStorage.getItem('alumnos')) {
        //si no hay creamos los alumnos base
        let alumnos = [
            {
                nombre: "Jose Carlos",
                apellidos: "Cumplido Gonzalez",
                email: "jcumgon1903@g.educaand.es",
                github: "https://github.com/JoseCumplido82",
                descripcion: "Sobreviviendo"
            },
            {
                nombre: "Selene",
                apellidos: "Pacheco Rodríguez",
                email: "spacrod308@g.educaand.es",
                github: "https://github.com/spachecor",
                descripcion: "Bienvenido a mi web, soy Selene y cuando termine me gustaría trabajar en algo remunerado"
            }
        ];
        //los agregamos
        localStorage.setItem('alumnos', JSON.stringify(alumnos));
    }
    //tomamos los alumnos y los pasamos a la función para crearlos en la tabla del DOM
    let alumnos = JSON.parse(localStorage.getItem('alumnos'));
    crearTablaAlumnosDOM(alumnos);
});
function crearTablaAlumnosDOM(alumnos) {
    //recorremos el array de alumnos
    $.each(alumnos, function (index, alumno) {
        //creamos el tr
        const tr = $('<tr></tr>')
        //creamos el th del numero del alumno
        const numeroAlumno = $('<th scope="row"></th>').text(index+1);
        //creamos el td del nombre del alumno
        const nombreAlumno = $('<td></td>').text(alumno.nombre)
        //creamos el td del nombre del alumno
        const apellidosAlumno = $('<td></td>').text(alumno.apellidos);
        //creamos el td del nombre del alumno
        const githubAlumno = $('<td></td>').text(alumno.github);
        //añadimos los elementos
        tr.append(numeroAlumno).append(nombreAlumno).append(apellidosAlumno).append(githubAlumno);
        //añadimos el tr al contenedor
        $('#tablaAlumnos').append(tr);
    });
}
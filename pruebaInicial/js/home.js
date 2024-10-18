$(document).ready(function () {
  //localStorage.removeItem('alumnos'); //PARA FORMATEAR LA LISTA SI ES NECESARIO
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
  //tomamos los alumnos y los pasamos a la función para crearlos en el DOM
  let alumnos = JSON.parse(localStorage.getItem('alumnos'));
  crearAlumnosDOM(alumnos);
  /*document.getElementById('file-input')
  .addEventListener('change', leerArchivo, false);*/
  $('#file-input').on('change', leerArchivo);
});
/**
 * Función que crea y agrega en el dom los alumnos que le entran por parámetro
*/
function crearAlumnosDOM(alumnos) {
  //recorremos el array de alumnos
  $.each(alumnos, function (index, alumno) {
    //creamos el div contenedor
    const divCol = $('<div class="col-12 mt-3"></div>');
    //creamos la figure
    const figure = $('<figure></figure>');
    //creamos el bloquequote
    const blockquote = $('<blockquote class="blockquote"></blockquote>');
    const h1 = $('<h1></h1>').text(alumno.nombre + " " + alumno.apellidos);
    blockquote.append(h1);
    //creamos el figcaption
    const figcaption = $('<figcaption class="blockquote-footer"></figcaption>');
    const cite = $('<cite></cite>').attr('title', 'Source Title').addClass('h5').text(alumno.descripcion);
    //añadimos los elementos
    figcaption.append(cite);
    figure.append(blockquote);
    figure.append(figcaption);
    divCol.append(figure);
    //añadimos el div al contenedor
    $('#contenedorAlumnos').append(divCol);
  });
}
/**
 * Función que guarda los datos que le entrar en un fichero nuevo cada vez que la llamamos
 * */
function guardarDatos() {
  //tomamos lo que ha introducido el usuario en los input
  const nombre = $('#nombre').val();
  const apellidos = $('#apellidos').val();
  const email = $('#email').val();
  const github = $('#github').val();
  const descripcion = $('#descripcion').val();
  //lo agregamos todo a un string
  const datos = `Nombre: ${nombre}\nApellidos: ${apellidos}\nEmail: ${email}\nGitHub: ${github}\nDescripción: ${descripcion}\n`;
  //formateamos la cadena con un objeto block para respetar los saltos de linea
  const blob = new Blob([datos], { type: 'text/plain' });
  //creamos una url única para el blob
  const url = URL.createObjectURL(blob);
  //creamos una url temporal para el blob para descargar como archivo
  const a = document.createElement('a');
  //asignamos la url
  a.href = url;
  //.download degine el archivo que se descargará
  a.download = 'datos-nuevo-alumno' + nombre + " " + apellidos + '.txt';
  document.body.appendChild(a);
  //simulamos el click sobre el elemento a que hemos creado para descargar el archivo
  a.click();
  //eliminamos el elemento a una vez ha complido su función
  document.body.removeChild(a);
  //revocamos el url creado para liberar memoria
  URL.revokeObjectURL(url);
  //llamamos al metodo para agregar el nuevo usuario al localStorage
  agregarUsuarioLocalStorage();
}
/**
 * Función que lee los datos de un archivo y los representa dentro de un elemento del DOM
*/
function leerArchivo(e) {
  //tomamos el archivo con el evento e de carga de archivos
  var archivo = e.target.files[0];
  //si no existe el archivo, sale del método
  if (!archivo) {
    return;
  }
  //Creamos una instancia de filereader para leer el contenido del archivo
  var lector = new FileReader();
  //definimos una función que se ejecutará cuando el archivo haya sido leído completamente.
  //e contiene información sobre el evento de lectura
  lector.onload = function (e) {
    //obtenemos el contenido del archivo
    var contenido = e.target.result;
    //llamamos a la funcion que procsa el contenido y lo muestra en el DOM
    mostrarContenido(contenido);
  };
  //inicia la lectura del archivo. Esto activará el evento onload anterior cuando termine de leerlo
  lector.readAsText(archivo);
}
/**
 * Función que agrega el contenido del archivo al DOM
 */
function mostrarContenido(contenido) {
  $('#contenido-archivo').html(contenido);
}
/**
 * Función que agrega un nuevo alumno a la lista de alumnos del localStorage
 * */
function agregarUsuarioLocalStorage() {
  //recuperamos la lista de usuarios existente
  let alumnos = JSON.parse(localStorage.getItem('alumnos'));

  //si no hay alumnos guardados, inicializamos un array vacío
  if (!alumnos) {
    alumnos = [];
  }

  //creamos el nuevo alumno
  let alumno = {
    nombre: $('#nombre').val(),
    apellidos: $('#apellidos').val(),
    email: $('#email').val(),
    github: $('#github').val(),
    descripcion: $('#descripcion').val()
  };

  //agregamos el nuevo alumno al array de alumnos
  alumnos.push(alumno);

  //guardamos la lista actualizada en localStorage
  localStorage.setItem('alumnos', JSON.stringify(alumnos));
  location.reload();
  console.log('Nuevo usuario agregado:', alumno);
}
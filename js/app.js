"use strict"

const URLAPI = "http://localhost/TPE2-WEB2/api/movies";
const TOKENAPI = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MSwibmFtZSI6Ikx1Y2EiLCJleHAiOjE2Njc1NzQ3ODB9.xAQnnEk-f9ZIPy-STJbEIlfCHP9w3coegboxZa-WAXw";

async function getAll() {
  try {
    let response = await fetch(URLAPI);
    if (!response.ok) {
      throw new Error('Recurso no existe');
    }
    let movies = await response.json();
    showMovies(movies);
  } catch (error) {
    console.log(error);
  }
}

function showMovies(movies) {
  let container = document.querySelector('.container .row');
  container.innerHTML = "";
  for (const movie of movies) {
    movie.description = movie.description.slice(0, 180);
    let html = `
  <div class="card col m-3" style="width: 18rem;">
  <img src="${movie.image}" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">${movie.title}</h5>
    <p class="card-text">${movie.description}</p>
    <div class="btn-container">
      <a href="item/${movie.id_movie}" class="btn btn-primary">Ver Mas</a>
        <a href="#" data-movie=${movie.id_movie} class="btn btn-danger">Eliminar</a>
        <a href="#" data-movie=${movie.id_movie} class="btn btn-warning">Editar</a>
    </div>
    </div>
    <div>
    <p>Genero: ${movie.name}</p>
    <p>Autor: ${movie.author}</p>
  </div>
  </div>
    `
    container.innerHTML += html;
  };
  let btnsDelete = document.querySelectorAll('a .btn-danger');
  let btnsEdit = document.querySelectorAll('a .btn-warning');
  btnsDelete.forEach(btnDelete => {
    btnDelete.addEventListener('click', deleteMovie);
  });
  btnsEdit.forEach(btnEdit => {
    btnEdit.addEventListener('click', editMovie);
  });
}



getAll();


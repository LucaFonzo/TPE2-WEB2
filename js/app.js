"use strict"

const URLAPI = "http://localhost/TPE2-WEB2/api/movies";
const TOKENAPI = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MSwibmFtZSI6Ikx1Y2EiLCJleHAiOjE2Njc1NzQ3ODB9.xAQnnEk-f9ZIPy-STJbEIlfCHP9w3coegboxZa-WAXw";

async function getAll(page = 1) {
  console.log(page);
  try {
    let response = await fetch(`${URLAPI}?page=${page}&limit=8`);
    if (!response.ok) {
      throw new Error('Recurso no existe');
    }
    let movies = await response.json();
    showMovies(movies,page);
  } catch (error) {
    console.log(error);
  }
}

function showMovies(movies,pageActual) {
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
  const containerButtons = document.createElement('div');
  const btnPast = document.createElement('button');
  const btnNext = document.createElement('button');
  btnPast.textContent = "Anterior";
  btnNext.textContent = "Siguente";
  btnPast.setAttribute('page-actual', pageActual);
  btnNext.setAttribute('page-actual', pageActual);
  btnPast.addEventListener('click', backPage);
  btnNext.addEventListener('click', nextPage);
  containerButtons.appendChild(btnPast);
  containerButtons.appendChild(btnNext);
  container.appendChild(containerButtons);
  let btnsDelete = document.querySelectorAll('a .btn-danger');
  let btnsEdit = document.querySelectorAll('a .btn-warning');
  btnsDelete.forEach(btnDelete => {
    btnDelete.addEventListener('click', deleteMovie);
  });
  btnsEdit.forEach(btnEdit => {
    btnEdit.addEventListener('click', editMovie);
  });
}


function backPage(e) {
  e.preventDefault();
  let pageActual = e.target.getAttribute("page-actual");
  if (pageActual == 1) {
    getAll();
  } else {
    pageActual--
    getAll(pageActual);
  }
}

function nextPage(e) {
  e.preventDefault();
  let pageActual = e.target.getAttribute("page-actual");
  pageActual++;
  getAll(pageActual);
}


getAll();


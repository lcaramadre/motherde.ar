// Mostrar logo 
let cont_logo = document.getElementById("cont-logo");
let logo = document.getElementById("logo");

// Animar las card 
let card = document.querySelectorAll(".card");

// Animar footer
const body = document.body;
// const nav = document.querySelector(".page-header nav");
// const menu = document.querySelector(".page-header .menu");
const scrollUp = "scroll-up";
const scrollDown = "scroll-down";
let lastScroll = 0;

function reinicioAnimacion(){
  for (var i=0; i < card.length; i++){
    card[i].style.opacity = 0;
    card[i].classList.remove("mostrarArriba");
  }
}

function animoCard(){
  let scrollTop = document.documentElement.scrollTop;

  // Animo las card 
  for (var i=0; i < card.length; i++){
    let alturaCard = card[i].offsetTop;
    let altoPantalla = window.innerHeight/1.2 ;
    if (alturaCard - altoPantalla < scrollTop){
      card[i].style.opacity = 1;
      card[i].classList.add("mostrarArriba");
    }
  }
}

function mostrarScroll(){
  let scrollTop = document.documentElement.scrollTop;
  let anchoPantalla = document.body.clientWidth;

  // Muestro u oculto el logo 
  if (scrollTop >= 100 && anchoPantalla>=900){
    cont_logo.style.display = "block";
    setTimeout('logo.style.opacity = 1', 100);
  }
  else{
    logo.style.opacity = 0;
    cont_logo.style.display = "none"
  }
  animoCard();
}

function mostrarFooter(){
  const currentScroll = window.pageYOffset;
  if (currentScroll == 0) {
    body.classList.remove(scrollUp);
    return;
  }

  if (currentScroll > lastScroll && !body.classList.contains(scrollDown)) {
    // down
    body.classList.remove(scrollUp);
    body.classList.add(scrollDown);
  } else if (currentScroll < lastScroll && body.classList.contains(scrollDown)) {
    // up
    body.classList.remove(scrollDown);
    body.classList.add(scrollUp);
  }
  lastScroll = currentScroll;
}

function secciones(id){
  let activo = document.getElementById(id);
  let obj = ["main","aside","sitios","servicios","contacto","describe","des-aside"];

  for(var i in obj){
    let desactivo = document.getElementById(obj[i]);
    if (activo!=desactivo){
      desactivo.style.display="none";
    }
  }
  if (id=='main'){
    let aside=document.getElementById('aside');
    aside.style.display="block";
  }
  if(id=='describe'){
    let des_aside=document.getElementById('des-aside');
    des_aside.style.display="block";
  }
  activo.style.display="block";
  reinicioAnimacion();
  setTimeout(animoCard(),100);
}

window.addEventListener('scroll', mostrarScroll);
window.addEventListener('scroll', mostrarFooter);
window.addEventListener('resize', mostrarScroll);
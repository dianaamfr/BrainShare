'use strict'

const sizeCarousel = document.querySelectorAll('.carousel .carousel-inner .carousel-item').length
let carouselItems = document.querySelectorAll('.carousel .carousel-inner .carousel-item')
// Change Between Questions and Answers
const rightButton = document.querySelector('.carousel-control-next')
const leftButton = document.querySelector('.carousel-control-prev')

let currentNumber = 0

function goRight() {
    currentNumber++
    let index = currentNumber % sizeCarousel
    currentNumber = index

    currentNumber = index
    console.log(index)

    for(let i = 0; i < sizeCarousel; i++) {
        carouselItems[i].className = "carousel-item"
    }
    carouselItems[index].className = "carousel-item active"
} 

function goLeft() {
    currentNumber--
    let index = currentNumber % sizeCarousel
    if(index == -1) {
        index = sizeCarousel - 1
    }

    currentNumber = index

    for(let i = 0; i < sizeCarousel; i++) {
        carouselItems[i].className = "carousel-item"
    }
    console.log("aqui");

    carouselItems[index].className = "carousel-item active"
    myMove(index)
} 

rightButton.addEventListener("click", goRight)
leftButton.addEventListener("click", goLeft)
import './styles/app.scss';
const $ = require('jquery');
import './Js/header';
import './bootstrap';
require('bootstrap')

const myCarouselElement = document.querySelector('#myCarousel')
const carousel = new bootstrap.Carousel(myCarouselElement, {
    interval: 2000,
    wrap: false
})
const dropdownElementList = document.querySelectorAll('.dropdown-toggle')
const dropdownList = [...dropdownElementList].map(dropdownToggleEl => new bootstrap.Dropdown(dropdownToggleEl))
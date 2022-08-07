/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
import './styles/app.scss';
const $ = require('jquery');
require('bootstrap');

const myCarouselElement = document.querySelector('#myCarousel')
const carousel = new bootstrap.Carousel(myCarouselElement, {
    interval: 2000,
    wrap: false
})

const dropdownElementList = document.querySelectorAll('.dropdown-toggle')
const dropdownList = [...dropdownElementList].map(dropdownToggleEl => new bootstrap.Dropdown(dropdownToggleEl))

// start the Stimulus application
import './bootstrap';

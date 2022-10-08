const slider = document.querySelector('.slider1');
const box = document.querySelectorAll('.slider1 .box1');

const preBtn = document.querySelector('#preBtn1');
const nextBtn = document.querySelector('#nextBtn1');

let counter = 1;
const size = box[0].clientWidth;

slider.style.transform = 'translateX(' + (-size * counter) + 'px)';

nextBtn.addEventListener('click', () => {
    if(counter >= box.length - 1) return;
    slider.style.transition = "transform 0.4s ease-in-out";
    counter++;
    slider.style.transform = 'translateX(' + (-size * counter) + 'px)';
})

preBtn.addEventListener('click', () => {
    if(counter <= 0) return;
    slider.style.transition = "transform 0.4s ease-in-out";
    counter--;
    slider.style.transform = 'translateX(' + (-size * counter) + 'px)';
})

slider.addEventListener('transitionend', () => {
    if(box[counter].id === 'lastClone1') {
        slider.style.transition = "none";
        counter = box.length - 2;
        slider.style.transform = 'translateX(' + (-size * counter) + 'px)';
    }
    if(box[counter].id === 'firstClone1') {
        slider.style.transition = "none";
        counter = box.length - counter;
        slider.style.transform = 'translateX(' + (-size * counter) + 'px)';
    }
})
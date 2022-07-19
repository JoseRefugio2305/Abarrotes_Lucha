function versvg(){
    var path = document.querySelector('.marco');
    var length = path.getTotalLength();
    var pathcir = document.querySelector('.circulo');
    var lengthcir = pathcir.getTotalLength();
    // Clear any previous transition
    path.style.transition = path.style.WebkitTransition = 'none';
    // Set up the starting positions
    path.style.strokeDasharray = length + ' ' + length;
    path.style.strokeDashoffset = length;
    // Trigger a layout so styles are calculated & the browser
    // picks up the starting position before animating
    path.getBoundingClientRect();
    // Define our transition
    path.style.transition = path.style.WebkitTransition =
    'stroke-dashoffset 2s ease-in-out';
    path.style.strokeDashoffset = '0';

    pathcir.style.transition = pathcir.style.WebkitTransition = 'none';
    // Set up the starting positions
    pathcir.style.strokeDasharray = lengthcir + ' ' + lengthcir;
    pathcir.style.strokeDashoffset = lengthcir;
    // Trigger a layout so styles are calculated & the browser
    // picks up the starting position before animating
    pathcir.getBoundingClientRect();
    // Define our transition
    pathcir.style.transition = pathcir.style.WebkitTransition =
    'stroke-dashoffset 2s ease-in-out';
    pathcir.style.strokeDashoffset = '0';

    setInterval(() => {
    // Clear any previous transition

    path.style.transition = path.style.WebkitTransition = 'none';
    // Set up the starting positions
    path.style.strokeDasharray = length + ' ' + length;
    path.style.strokeDashoffset = length;
    // Trigger a layout so styles are calculated & the browser
    // picks up the starting position before animating
    path.getBoundingClientRect();
    // Define our transition
    path.style.transition = path.style.WebkitTransition =
    'stroke-dashoffset 2s ease-in-out';
    path.style.strokeDashoffset = '0';

    pathcir.style.transition = pathcir.style.WebkitTransition = 'none';
    // Set up the starting positions
    pathcir.style.strokeDasharray = lengthcir + ' ' + lengthcir;
    pathcir.style.strokeDashoffset = lengthcir;
    // Trigger a layout so styles are calculated & the browser
    // picks up the starting position before animating
    pathcir.getBoundingClientRect();
    // Define our transition
    pathcir.style.transition = pathcir.style.WebkitTransition =
    'stroke-dashoffset 2s ease-in-out';
    pathcir.style.strokeDashoffset = '0';
    }, 3000);
}
$(document).ready(function(){
    window.addEventListener('scroll',function(){
        let lastScrollY = 0;
        let navElm = document.querySelector('nav');
        if(window.scrollY>lastScrollY){
           navElm.classList.remove('bg-transparent');
           navElm.classList.add('bg-dark');
           console.log(123)
        }else{
            navElm.classList.remove('bg-dark');
            navElm.classList.add('bg-transparent');
        }
    })
});
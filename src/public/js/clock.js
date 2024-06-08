document.addEventListener('DOMContentLoaded', function(){
    document.onreadystatechange = () => {
        if(document.readyState == "complete"){
            let hh = document.getElementsByClassName("hours")[0];
            let mm = document.getElementsByClassName("min")[0];
            let ss = document.getElementsByClassName("sec")[0];
            setInterval( function() {
                let date = new Date();
                let hours = date.getHours();
                let minutes = date.getMinutes();
                let seconds = date.getSeconds();
                hh.innerHTML = ( hours < 10 ? "0" : "" ) + hours;
                mm.innerHTML = ( minutes < 10 ? "0" : "" ) + minutes;
                ss.innerHTML = ( seconds < 10 ? "0" : "" ) + seconds;
                }, 1000);
        }
    }
});

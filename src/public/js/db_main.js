document.addEventListener('DOMContentLoaded', function(){
    document.onreadystatechange = () => {
        if(document.readyState == "complete"){
            document.getElementsByClassName("btn-tooltip").tooltip({
                placement: "auto"
            });
        }
    }
});

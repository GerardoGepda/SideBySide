const filtroU = document.querySelector('#searchUGraph');

filtroU.addEventListener('change', () => {
    filtrarU(filtroU.value);
});

function filtrarU(idU) {
    const unis = document.getElementsByClassName('uni-content');
    if (idU === "all") {
        for (const uni of unis) {
            uni.classList.remove('d-none');
        }
    }else{
        for (const uni of unis) {
            uni.classList.remove('d-none');
            if (uni.classList[2] !== idU) {
                uni.classList.add('d-none');
            }
        }
    }
}
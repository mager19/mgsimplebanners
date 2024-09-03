document.addEventListener('DOMContentLoaded', function () {
    let mg_single_banners_container = document.querySelector('.mg_simple_banners_container');
    let mg_single_banners_close = document.querySelector('.mg_single_banners_close');

    if (mg_single_banners_container) {
        mg_single_banners_close.addEventListener('click', function () {
            console.log('clicked');
            mg_single_banners_container.style.transform = "translateY(-200px)";
            setTimeout(function () {
                mg_single_banners_container.remove();
            }, 1200);

        });
    }
});
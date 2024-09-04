document.addEventListener('DOMContentLoaded', function () {
    let mg_single_banners_container = document.querySelector('.mg_simple_banners_container');
    let mg_single_banners_close = document.querySelector('.mg_single_banners_close');
    let link = document.querySelector('.mg_single_banners_link');
    let x = document.querySelector('.mg_single_banners_close svg path');

    console.log(MG_SIMPLE_BANNERS_OPTIONS);

    if (mg_single_banners_container) {
        mg_single_banners_close.addEventListener('click', function () {
            console.log('clicked');
            mg_single_banners_container.style.transform = "translateY(-200px)";
            setTimeout(function () {
                mg_single_banners_container.remove();
            }, 1200);

        });

        mg_single_banners_container.style.background = (MG_SIMPLE_BANNERS_OPTIONS.background !== '') ? MG_SIMPLE_BANNERS_OPTIONS.background : '#000';
        mg_single_banners_container.style.color = (MG_SIMPLE_BANNERS_OPTIONS.color !== '') ? MG_SIMPLE_BANNERS_OPTIONS.color : '#fff';
        x.style.stroke = (MG_SIMPLE_BANNERS_OPTIONS.color !== '') ? MG_SIMPLE_BANNERS_OPTIONS.color : '#fff';
        link.style.color = (MG_SIMPLE_BANNERS_OPTIONS.linkColor !== '') ? MG_SIMPLE_BANNERS_OPTIONS.linkColor : '#f9f9f9';
    }
});
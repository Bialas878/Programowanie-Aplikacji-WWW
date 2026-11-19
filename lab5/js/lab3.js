$(document).ready(function() {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    if (prefersReducedMotion.matches) {
        $.fx.off = true;
    }

    let stanA = false;
    $('#anim-a').on('click', function() {
        stanA = !stanA;
        $(this).attr('aria-pressed', stanA);
        
        const docelowaSzerokosc = stanA ? 240 : 160;
        const docelowaWysokosc = stanA ? 130 : 90;

        $(this).stop(true, false).animate({
            width: docelowaSzerokosc + 'px',
            height: docelowaWysokosc + 'px'
        }, 300);
    });

    let isHovered = false;
    let isFocused = false;

    function aktualizujAnimacjeB() {
        const docelowaSzerokosc = (isHovered || isFocused) ? 220 : 160;
        const docelowaWysokosc = (isHovered || isFocused) ? 120 : 90;

        $('#anim-b').stop(true, false).animate({
            width: docelowaSzerokosc + 'px',
            height: docelowaWysokosc + 'px'
        }, 300);
    }

    $('#anim-b').on('mouseenter', function() {
        isHovered = true;
        aktualizujAnimacjeB();
    }).on('mouseleave', function() {
        isHovered = false;
        aktualizujAnimacjeB();
    }).on('focus', function() {
        isFocused = true;
        aktualizujAnimacjeB();
    }).on('blur', function() {
        isFocused = false;
        aktualizujAnimacjeB();
    });

    let krokiC = 0;
    $('#anim-c').on('click', function() {
        if ($(this).is(':animated') || krokiC >= 5) {
            return;
        }

        krokiC++;
        $('#licznik-c').text(krokiC);

        const nowaSzerokosc = 160 + (krokiC * 20);
        const nowaWysokosc = 90 + (krokiC * 10);

        $(this).animate({
            width: nowaSzerokosc + 'px',
            height: nowaWysokosc + 'px'
        }, 300);
    });

    $('#btn-reset').on('click', function() {
        stanA = false;
        $('#anim-a').attr('aria-pressed', 'false')
                    .stop(true, true)
                    .css({ width: '160px', height: '90px' });

        krokiC = 0;
        $('#licznik-c').text(krokiC);
        $('#anim-c').stop(true, true)
                    .css({ width: '160px', height: '90px' });
    });

    $('#btn-sprawdz').on('click', function() {
        const przycisk = $(this);
        const obszarWyniku = $('#obszar-wyniku');

        przycisk.prop('disabled', true);
        obszarWyniku.text('Ładowanie...');

        $.ajax({
            url: 'status.php',
            method: 'GET',
            dataType: 'text',
            timeout: 5000 
        })
        .done(function(odpowiedz) {
            obszarWyniku.text(odpowiedz);
        })
        .fail(function() {
            obszarWyniku.text('Wystąpił błąd komunikacji z serwerem.');
        })
        .always(function() {
            przycisk.prop('disabled', false);
        });
    });
});
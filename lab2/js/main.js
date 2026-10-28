function wyglad(){
    const zapisanyMotyw = localStorage.getItem('wybranyMotyw');

    if(zapisanyMotyw == 'dark'){
        document.documentElement.setAttribute('data-theme','dark');
    }
    else{
        document.documentElement.setAttribute('data-theme','light');
    }

    const wygladowo=document.querySelector('#wygladowo');
    if(wygladowo){
        wygladowo.addEventListener('click',function(){
            const aktualny_motyw=document.documentElement.getAttribute('data-theme')
            if(aktualny_motyw=='dark'){
                document.documentElement.setAttribute('data-theme','light');
                localStorage.setItem('wybranyMotyw','light');
            }
            else{
                document.documentElement.setAttribute('data-theme','dark');
                localStorage.setItem("wybranyMotyw",'dark');
            }
        })
    }
}

function zegar(){
    const wyswietlacz=document.querySelector('#wyswietlanie_czasu');
    const start=document.querySelector("#btn-start");
    const stop=document.querySelector("#btn-stop");
    if(wyswietlacz && start && stop){
        let idInterwal;
        function aktualizujZegar(){
            const czas=new Date();
            const info={year:'numeric',month: 'numeric', day: 'numeric',hour: '2-digit',minute:'2-digit',second:'2-digit'};
            const format=new Intl.DateTimeFormat('pl-PL', info).format(czas);
            wyswietlacz.textContent=format;


    }
    aktualizujZegar();
    start.addEventListener('click', function() {clearInterval(idInterwal);idInterwal=setInterval(aktualizujZegar, 1000)});
    stop.addEventListener('click',function(){clearInterval(idInterwal)});
}}

function Wyszukiwanie(){
    const szukaj = document.querySelector('#Wyszukiwarka');
    const Licznik=document.querySelector('#licznik');

    if (szukaj){
        szukaj.addEventListener('input', function(){
            const szukane = szukaj.value.trim().toLowerCase();
            const karty = document.querySelectorAll('.karta');

            let ilosc=0;
            
            karty.forEach(function(karta){
                const nazwa = karta.querySelector('h2').textContent.toLowerCase();

                if (nazwa.includes(szukane)){
                    karta.hidden = false;
                    ilosc++;
                } else {
                    karta.hidden = true;
                }
            });
            if (Licznik){
                Licznik.textContent = ilosc;
            }
        });
    }
}
const produktySklepu = [
    { id: "Uchwyty", nazwa: "Uchwyty do pompek", cenaGrosze: 2899 },
    { id: "Bieżnia", nazwa: "Bieżnia LIGHT", cenaGrosze: 99998 },
    { id: "drazek", nazwa: "Naścienny drążek do podciągania", cenaGrosze: 29900 }
];

function obliczWartosc(cenaGrosze, ilosc) {
    return cenaGrosze * ilosc;
}

function obslugaFormularza() {
    const selectProdukt = document.querySelector('#wyborProduktu');
    const inputIlosc = document.querySelector('#wyborIlosci');
    const formularz = document.querySelector('form');
    const wynikCeny = document.querySelector('#wynik-ceny');
    const wynikPodsumowania = document.querySelector('#wynik-podsumowania');
    const inputEmail = document.querySelector('#emailKlienta');
    const Wiadomosc = document.querySelector('#wiadomoscKlienta');

    if (selectProdukt && inputIlosc && formularz) {
        
        formularz.addEventListener('input', function() {
            const wybranyId = selectProdukt.value;
            const ilosc = parseInt(inputIlosc.value);
            const produkt = produktySklepu.find(p => p.id === wybranyId);

            wynikPodsumowania.textContent = "";

            if (produkt && !isNaN(ilosc) && ilosc >= 1 && ilosc <= 5) {
                const sumaGrosze = obliczWartosc(produkt.cenaGrosze, ilosc);
                
                const sformatowanaCena = new Intl.NumberFormat('pl-PL', {
                    style: 'currency',
                    currency: 'PLN'
                }).format(sumaGrosze / 100);

                wynikCeny.textContent = "Szacowana wartość: " + sformatowanaCena;
            } else {
                wynikCeny.textContent = "Wprowadź poprawną ilość (od 1 do 5) i wybierz produkt.";
            }
        });

        formularz.addEventListener('submit', function(e) {
            e.preventDefault();

            const email = inputEmail.value.trim();
            const wybranyId = selectProdukt.value;
            const ilosc = parseInt(inputIlosc.value);
            const wiadomosc = Wiadomosc.value.trim();
            const produkt = produktySklepu.find(p => p.id === wybranyId);

            if (wiadomosc.length < 10) {
                alert("Wiadomość musi mieć co najmniej 10 znaków");
                Wiadomosc.focus();
                return;
            }

            if (produkt && !isNaN(ilosc)) {
                const sumaGrosze = obliczWartosc(produkt.cenaGrosze, ilosc);
                const sformatowanaCena = new Intl.NumberFormat('pl-PL', {
                    style: 'currency',
                    currency: 'PLN'
                }).format(sumaGrosze / 100);

                wynikPodsumowania.textContent = `E-mail: ${email} | Produkt: ${produkt.nazwa} | Ilość: ${ilosc} | Wartość: ${sformatowanaCena} | Wiadomość: ${wiadomosc}`;
            }
        });
    }
}
wyglad();
zegar();
Wyszukiwanie();
obslugaFormularza();
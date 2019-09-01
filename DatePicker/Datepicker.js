const date_picker_element = document.querySelector('.date_picker');
const selected_date_element = document.querySelector('.date_picker .selected_date');
const date_element = document.querySelector('.date_picker .dates');
const mth_element = document.querySelector('.date_picker .dates .months .mth');
const prev_mth_element = document.querySelector('.date_picker .dates .months .prev_mth');
const next_mth_element = document.querySelector('.date_picker .dates .months .next_mth');
const days_element = document.querySelector('.date_picker .dates .days');

const months =['Janvier','Fevrier','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Decembre'];

let date = new Date();
let day = date.getDate();
let month = date.getMonth();
let year = date.getFullYear();

let selectedDate = date;
let selectedDay = day;
let selectedMonth = month;
let selectedYear = year;

//recuperer le mois et l annee
mth_element.textContent = months[month] + ' ' + year;

//recupere le jour
selected_date_element .textContent = formatDate(date);
selected_date_element .textContent = formatDate(date);


//EVENTLISTENER
date_picker_element.addEventListener('click', calendrier);
next_mth_element.addEventListener('click', goToNextMonth);
prev_mth_element.addEventListener('click', goToPrevMonth);

populateDates();

//FUNCTION


//function du calendrier
function calendrier(e) {

    console.log(e.path);

    if (!checkcalendrier(e.path, date_element)) {
        date_element.classList.toggle('active');
        console.log('Vrai');
    }
    else{
        console.log('Faux');
    }
}

//function mois d apres

function goToNextMonth(i)
{
    month++;
    if(month > 11){
        month=0;
        year++;
    }
    mth_element.textContent = months[month] + ' ' + year;
    populateDates();
}

//function mois d avant

function goToPrevMonth(i)
{
    month--;
    if(month < 0){
        month=11;
        year--;
    }
    mth_element.textContent = months[month] + ' ' + year;
    populateDates();
}

// cree les jours du calendrier+ la selection du jour+jours actelle surbriance
function populateDates(e)
{
    days_element.innerHTML = '';
    let amount_days = 31

    if (month == 1) {
        amount_days =28
    }
    for(let i =0; i< amount_days; i++)
    {
        const day = document.createElement('div');
        day.classList.add('day');
        day.textContent =i + 1;

        if(selectedDay == (i+1) && selectedMonth ==month && selectedYear == year){
            day.classList.add('selected')
        }

        day.addEventListener('click', function(){
            selectedDate =new Date(year + '-' + (month + 1) + '-' + ( i + 1 ));
            selectedDay = (i + 1);
            selectedMonth = month;
            selectedYear = year;

            selected_date_element.textContent = formatDate(selectedDate)
            selected_date_element.dataset.value = selectedDate;

            populateDates()
        })

        days_element.appendChild(day)

    }
}



//FUNCTION HELPER

//Function pour empecher  le calendrier de ce fermer un fois ouvert  si on click autre part que sur la fermeture
function checkcalendrier(path, verif) {
    for (let i = 0; i < path.lenght; i++) {
        if (path[i].classList && path[i].classList.contains(verif)) {
            return true;
        }
    }

    return false;
}

function formatDate(d)
{
    var day =d.getDate();
    if(day < 10){
        day ='0' + day;
    }
    var month =d.getMonth() +1 ;
    if(month < 10){
        month ='0' + month;
    }
    var year =d.getFullYear();

    return day +'/'+ month + '/' + year;
}


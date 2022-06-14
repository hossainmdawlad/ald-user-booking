
// import '../../node_modules/vanillajs-datepicker/sass/datepicker.scs';
import JsTabs from 'js-tabs';
import { Datepicker } from 'vanillajs-datepicker';


const ald_user_booking_Tabs = new JsTabs({
    elm: '#ald_user_booking-js-tabs'
})

document.getElementById('ald_user_booking-js-tabs').querySelector('.date_today').innerHTML = 'Date today: '+new Date(Date.now()).toDateString();


const elem = document.getElementById('ald_user_booking');
const datepicker = new Datepicker(elem, {
    buttonClass: 'btn',
    daysOfWeekDisabled: [0,6],
    format: 'yyyy-mm-dd',
    minDate: Date.now(),
    defaultViewDate: Date.now(),
    todayHighlight: true,
    maxNumberOfDates: 300,
    datesDisabled: [],
    maxView: 2,

}); 

var get_user_booking_dates = await get_single_user_booking_dates();
// datepicker.setDate(["2022-06-15 00:00:00","2022-06-27 00:00:00","2022-06-20 00:00:00","2022-06-21 00:00:00"],{
//     format: 'yyyy-mm-dd H:m:s',
// });
datepicker.setDate(get_user_booking_dates,{
    format: 'yyyy-mm-dd',
});

async function get_single_user_booking_dates(){
    let formData = new FormData();
    formData.append( 'action', 'get_single_user_booking_dates' );
    
    const response = await fetch(ald_user_bookingAjax.ajaxurl, {
        credentials: 'same-origin',
        method: "POST",
        body: formData,
    })
    .catch(err => {
        console.log('Request Failed', err);
    });
    const data = await response.json();
    return data;
}

elem.addEventListener('click', function(e){
    console.log(e.target.getAttribute("data-date"));
    const unixTimestamp = e.target.getAttribute("data-date");
    const milliseconds = unixTimestamp * 1000; // 1575909015000
    const dateObject = new Date(milliseconds);
    const humanDateFormat = new Date(e.target.getAttribute("data-date"));
    
    // console.log(datepicker.getDate());

    // return false;
    let formData = new FormData();
    formData.append( 'action', 'store_user_booking' );
    formData.append("submitted_date", e.target.getAttribute("data-date"));
    
    fetch(ald_user_bookingAjax.ajaxurl, {
        credentials: 'same-origin',
        method: "POST",
        body: formData,
    })
    .then(response => response.json())
    .then(json => {
        console.log(json);
    if (json.status == 200) {
        console.log(json.message);
        // mailcrypt_terget_form.getElementsByClassName("mailcrypt-response-output")[0].innerHTML = json.message;
        // mailcrypt_terget_form.getElementsByClassName("mailcrypt-response-output")[0].style.display = 'block';
        // mailcrypt_terget_form.getElementsByClassName("mailcrypt-response-output")[0].style.borderColor = 'green';
    }else{
        console.log(json.error);
        // mailcrypt_terget_form.getElementsByClassName("mailcrypt-response-output")[0].innerHTML = json.error;
        // mailcrypt_terget_form.getElementsByClassName("mailcrypt-response-output")[0].style.display = 'block';
        // mailcrypt_terget_form.getElementsByClassName("mailcrypt-response-output")[0].style.borderColor = 'red';
    }
    })
    .catch(err => {
        console.log('Request Failed', err);
    });
});

const month_elem = document.getElementById('ald_user_booking_monthly');
const monthly_user_calender = new Datepicker(month_elem, {
    buttonClass: 'btn',
    daysOfWeekDisabled: [0,6],
    format: 'dd/mm/yyyy',
    // defaultViewDate: Date.now(),
    todayHighlight: true,
    datesDisabled: [],
    maxView: 2,
    showOnClick: true,

}); 

month_elem.addEventListener('changeDate', function(){
    console.log('test');
    console.log(monthly_user_calender.getDate());
});

ald_user_booking_Tabs.init();
// monthly_user_calender.init();
// datepicker.init();


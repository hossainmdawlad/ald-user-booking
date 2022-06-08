
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
    format: 'dd/mm/yyyy',
    minDate: Date.now(),
    defaultViewDate: Date.now(),
    todayHighlight: true,
    maxNumberOfDates: 22,
    datesDisabled: [],
    maxView: 2,

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


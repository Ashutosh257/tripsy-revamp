

const DateTime = easepick.DateTime;
const today = new DateTime();


const bookedDates = [
  ['1970-01-01', today.subtract(1)],
].map(d => {
  if (d instanceof Array) {
    const start = new DateTime(d[0], 'YYYY-MM-DD');
    const end = new DateTime(d[1], 'YYYY-MM-DD');
    
    return [start, end];
  }
  
  return new DateTime(d, 'YYYY-MM-DD');
});

// bookedDates.push(today.subtract(1, 'day'))

// console.log(bookedDates);

const picker = new easepick.create({
  element: document.getElementById('datepicker'),
  inline: true,
  grid: 2,
  calendars: 2,
  // autoApply: false, //- display apply/cancel buttons
  format: "YYYY-MM-DD", 
  css: [
    'https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.0/dist/index.css',
    'https://cdn.jsdelivr.net/npm/@easepick/range-plugin@1.2.0/dist/index.css',
    'css/daterange.css'
  ],
  plugins: ['RangePlugin', 'LockPlugin'],
  RangePlugin: {
    tooltipNumber(num) {
      return num - 1;
    },
    locale: {
      one: 'night',
      other: 'nights',
    },
    // startDate: new DateTime(),
    // endDate: new DateTime().add(1)
  },

  LockPlugin:{
    minDate: new Date(),
    minDays: 2,
    // inseparable: true,
    filter(date, picked) {
      if (picked.length === 1) {
        const incl = date.isBefore(picked[0]) ? '[)' : '(]';
        return !picked[0].isSame(date, 'day') && date.inArray(bookedDates, incl);
      }

      return date.inArray(bookedDates, '[)');
    },
  },


  setup(picker) {
    picker.on('select', (e) => {
      const { end, start } = e.detail;
      // console.log(e);
      var night = $('.night')
      var night_label = $('.night-label')

      var stay = end.diff(start)
      if(stay == 1){
        night.html(`1`)
        night_label.html('Night')
      }else{
        night.html(`${stay}`)
        night_label.html(`Nights`)
      }
      // console.log(end.diff(start));


      var price = Number($(".price").text())
      // console.log(price*stay);
      $(".final-price").html(String(price*stay))

    });
  },
});


// // add AmpPlugin to the picker
// const ampPlugin = picker.PluginManager.addInstance('AmpPlugin');

// // change plugin option
// ampPlugin.options.resetButton = true;




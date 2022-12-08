// $(function () {
//     'use strict';

//     // -- Lenguajes
//     var defaultLenguaje = 'es'
//     // --
//     if (localStorage.getItem('lenguaje') === null) {
//         localStorage.setItem('lenguaje', 'es')
//     } else {
//         defaultLenguaje = localStorage.getItem('lenguaje')
//     }

//     // --
//     if (defaultLenguaje == 'es') {
//         // --
//         $('.dropdown-language .dropdown-item').siblings('.selected').removeClass('selected');
//         $('.dropdown-language .dropdown-item').addClass('selected');
//         // --
//         $('#dropdown-flag .selected-language').text('Español')
//         $('#dropdown-flag .flag-icon').removeClass().addClass('flag-icon flag-icon-pe');
//         // --
//         $('.dropdown-language .dropdown-item').data('es');
//     } else {
//         $('.dropdown-language .dropdown-item').siblings('.selected').removeClass('selected');
//         $('.dropdown-language .dropdown-item').addClass('selected');
//         // --
//         $('#dropdown-flag .selected-language').text('English');
//         $('#dropdown-flag .flag-icon').removeClass().addClass('flag-icon flag-icon-us');
//         // --
//         $('.dropdown-language .dropdown-item').data('en');
//     }
//     // --
//     i18next.use(window.i18nextXHRBackend).init(
//         {
//         debug: false,
//         fallbackLng: defaultLenguaje,
//         backend: {
//             loadPath: BASE_URL + 'public/app-assets/' + 'data/locales/{{lng}}.json'
//         },
//         returnObjects: true
//         },
//         function (err, t) {
//         // resources have been loaded
//         jqueryI18next.init(i18next, $);
//         // --
//         i18next.changeLanguage(defaultLenguaje, function (err, t) {
//             $('.full-content').localize();
//         });
//         }
//     );

//     // change language according to data-language of dropdown item
//     $('.dropdown-language .dropdown-item').on('click', function () {
//         // --
//         var $this = $(this);
//         // --
//         $this.siblings('.selected').removeClass('selected');
//         $this.addClass('selected');
//         // --
//         var selectedLang = $this.text();
//         var selectedFlag = $this.find('.flag-icon').attr('class');
//         // --
//         $('#dropdown-flag .selected-language').text(selectedLang);
//         $('#dropdown-flag .flag-icon').removeClass().addClass(selectedFlag);
//         // --
//         var currentLanguage = $this.data('language');
//         // --
//         i18next.changeLanguage(currentLanguage, function (err, t) {
//         $('.full-content').localize(); 
//         $('#permissions').localize()
//         });
//         // -- Set lenguaje
//         localStorage.setItem('lenguaje', $this.data('language'));
//     });
    
// });
  
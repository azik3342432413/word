Vue.use(VueMask.VueMaskPlugin);

Vue.component('vue-multiselect', window.VueMultiselect.default)

let timeElems = [];


setTimeout(() => {

if(typeof real_estate_selected == 'undefined') return false;    

    
const app = new Vue({
    el: '#real-estate',
   
    data: {
        errors: [],
        action: null,
        name: null,
        surname: null,
        patronymic: null,
        company: '',
        item:null,
        fullname:null,
        email: null,
        phone: null,
        subject:'',
        message: null,
        req_type: '',
        subject_type:'',
        product_type:'',
        response_type:'',
        file: {
            name: null,
            size: 0
        },
        file_url: '',
        fields: null,
        savingSuccessful: false,
        tokenTake: true,
        uploadPercentage: 0,
        captchaKey:'6LeMNmYeAAAAAPdGr1cfe-sLH3zgAAtRqpf8VsSF',
        captchaToken:null,
        preload: false,
        insurances: [],
        insure: false,

        real_estate_selected: real_estate_selected,
        real_estates: real_estates,
        isLoading: false,
        company_fetch: true,
        company_input_show: false
    },


    methods: {
     

        nameWithLang ({ name, companyName }) {
            return companyName
        },

        search(searchTerm, data) {

            let _this = this;

            var pattern = new RegExp('^.*' + searchTerm.replace(/%/g, '.*') + '.*$', 'i');
            let res = data.filter(function(obj) {
                return pattern.test(obj.companyName);
            });

            _this.companies = res;
            _this.isLoading = false;
            
        },

    
    }
});




}, 1000);


(function($){

    $.datetimepicker.setDateFormatter({
        parseDate: function (date, format) {
            var d = moment(date, format);
            return d.isValid() ? d.toDate() : false;
        },
        formatDate: function (date, format) {
            return moment(date).format(format);
        },
    });
    var datesConfigs = {
        format: "YYYY-MM-DD",
        formatDate: "YYYY-MM-DD",
        timepicker: false,
        minDate: 0
    };
    var datetimeConfigs = {
        format: "YYYY-MM-DD",
        formatDate: "YYYY-MM-DD",
        timepicker: false,
        minDate: 0
    };
    $("#hq-pick-up-date").datetimepicker(datesConfigs);
    $("#hq-return-date").datetimepicker(datesConfigs);
    $("#pick_up_datetime").datetimepicker(datetimeConfigs);
    $("#return_datetime").datetimepicker(datetimeConfigs);
    $("#hq-home-form").on("submit",function(event){
        var beginDate = moment($("#hq-pick-up-date").val() ,"YYYY-MM-DD");
        var endDate = moment($("#hq-return-date").val() ,"YYYY-MM-DD");
        if(endDate.diff(beginDate, 'days') < hqHomeFormShareData.hqMinimumPeriod){
            event.preventDefault();
            alert('Minimum Period of Time is: ' + hqHomeFormShareData.hqMinimumPeriod + ' days');
            return false;
        }
    });
    $("#hq-products-page-form").on("submit",function(event){
        var beginDate = moment($("#pick_up_datetime").val() ,"YYYY-MM-DD");
        var endDate = moment($("#return_datetime").val() ,"YYYY-MM-DD");
        if(endDate.diff(beginDate, 'days') < 7){
            event.preventDefault();
            alert('Minimum Period of Time is: ' + 7 + ' days');
            return false;
        }
    });
})(jQuery);
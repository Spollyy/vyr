/**
 * Created by ilya on 10.03.15.
 */
$("document").ready(function () {
    $(".go").click(function () {
        // no more clicks until timer expires
        $(this).attr("disabled", "disabled");

        // do whatever you want on the click here

        // set timer to re-enable the button
        setTimeout(function () {
            $(".go").removeAttr("disabled");
        }, 60 * 60 * 1000);
    });
});
var timer;
function up()
{
    timer = setTimeout(function(){
        var keywords = $('#search_input').val();
        if (keywords.length >0 )
        {
            $.post('http://viruchatel.u42697.netangels.ru/public/search', {keywords: keywords}, function(markup){
                $('#search_result').html(markup);
            });
        }
    },500);
}
function down() {
    clearTimeout(timer);
}

function search()
{
    timer = setTimeout(function(){
        var keywords = $('#search_input').val();
        if (keywords.length >0 )
        {
            $.post('http://viruchatel.u42697.netangels.ru/public/widesearch', {keywords: keywords}, function(markup){
                window.location.href = "http://viruchatel.u42697.netangels.ru/public/widesearch".html(markup);
            });
        }
    },500);
}


let template = $('#template');
let international_section = $('.international_items');
let internal_items = $('.internal_items');


function ajax(data , callback = null)
{
    $.ajax({
        url: '/server' , method: 'GET', data: data ,
        success: function (response){
            if (callback === 'create_server') createServers(response);
            if (callback === 'showPingResult') {
                console.log(response.data);
                showPingResult(response);
            }
        },
        error: function (response) {
            //console.log(response);
        }
    });
}



function createServers(response)
{
    let item = template.clone();
    let servers =  response.data ;

    for( let i in servers)
    {
        let server = servers [i];
        let name = server['name'] ?? '' ;
        let url = server['url'] ?? '' ;
        let type = server['type'] ?? '' ;

        item.find('.item_server').attr("id",'item_' + name);
        item.find('.item_server').removeClass('d-none');
        item.find('.server_name_text').first().html(name);
        item.find('.server_type').first().html('(' + type + ')');
        //item.find('.ping_time').first().html(0);
        //item.find('.ping_lost').first().html(0);
        item.find('.server_address').first().val(url);
        if ( server['is_international'] ) international_section.append(item.html());
        else internal_items.append(item.html());

        ajax({ operation:'ping' , server:url , name:name } , 'showPingResult');

    }

}


function showPingResult(response)
{
    let data = response.data;
    let item = $( '#item_' + data.name);

    item.find('.ping_lost').first().html( data.lost );

    if (data.status)
    {
        item.find('.ping_time').first().html(data.time);
        //item.find('.server_average').first().html( "(average :  " + data.average + " )");

        let class_name = getClass(data.time);
        item.find('.timing_section').first().removeClass('b-success b-normal b-warning b-danger').addClass(class_name);
        item.find('.lost_section').first().removeClass('b-success b-normal b-warning b-danger').addClass(class_name);
        item.removeClass('light_success light_normal light_warning light_danger').addClass(getServerClass(data.time));
    }
    else
    {
        item.find('.ping_time').first().html('0');
        item.find('.timing_section').first().removeClass('b-success b-normal b-warning').addClass('b-danger');
        item.find('.lost_section').first().removeClass('b-success b-normal b-warning').addClass('b-danger');
    }

    setTimeout(function (){
        ajax({ operation:'ping' , server:data.server , name:data.name } , 'showPingResult')
    } , 5000);


}

function getClass(time)
{
    if  (time <= 70 ) return 'b-success' ;
    if ( 70 < time <= 130 ) return 'b-normal' ;
    if ( 130 < time <= 180 ) return 'b-warning' ;
    else return 'b-danger';
}

function getServerClass(time)
{
    if  (time <= 70 ) return 'light_success' ;
    if ( 70 < time <= 130 ) return 'light_normal' ;
    if ( 130 < time <= 180 ) return 'light_warning' ;
    else return 'light_danger';
}



$(document).ready(function () {

    international_section.html('');
    internal_items.html('');
    ajax({operation:'servers' } , 'create_server' );

});







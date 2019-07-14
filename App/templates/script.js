$(function() {
    $.ajax({
        url:$('#tab2').attr('href'),
        success: function(data) {
            document.getElementById('block').innerHTML = data;
        }
    });
    return false;
});


$('#tab1').click(function() {
    $(this).addClass('active');
    $('#tab2').removeClass('active')
});


$('#tab2').click(function() {
    $(this).addClass('active');
    $('#tab1').removeClass('active')
});

$(function() {
    $('.tabs a').click(function() {
        $.ajax({
            url:$(this).attr('href'),
            success: function(data) {
                document.getElementById('block').innerHTML = data;
            }
        });
        return false;
    });
});


function show(element) {
    var id = element.id;
    id = id.substr(-1, 1);
        $('#view' + id).hide();
        $('#dropdown' + id).slideToggle('fast');
        $('#hide' + id).show();
        $('#hr' + id).slideToggle('fast');
}

function hide(element) {
    var id = element.id;
    id = id.substr(-1, 1);
        $('#dropdown' + id).slideToggle('fast');
        $('#view' + id).show();
        $('#hide' + id).hide();
        $('#hr' + id).slideToggle('fast');
}

var counter_numbers = document.getElementById('phoneNumbers').children.length;

function addNumber() {
    counter_numbers++;
    var div = document.createElement("div");
    div.className = "section";
    div.innerHTML = "<input type=\"hidden\" name=\"number_publish_" + counter_numbers + "\" value=\"1\">\n" +
        "            <input type=\"checkbox\" name=\"number_publish_" + counter_numbers + "\" value=\"2\">\n" +
        "            <div class=\"phonelabel\">Publish Field</div>\n" +
        "            <input pattern=\"((\\+380|0)[0-9]{9})\" title=\"Input valid phone number!\" name=\"number_" + counter_numbers + "\" type=\"text\" placeholder=\"+1234567890\" size=\"18\">";
    document.getElementById('phoneNumbers').appendChild(div);
}

var counter_emails = document.getElementById('emails').children.length;

function addEmail() {
    counter_emails++;
    var div = document.createElement("div");
    div.className = "section";
    div.innerHTML = "<input type=\"hidden\" name=\"email_publish_" + counter_emails + "\" value=\"1\">\n" +
        "            <input type=\"checkbox\" name=\"email_publish_" + counter_emails + "\" value=\"2\">\n" +
        "            <div class=\"phonelabel\">Publish Field</div>\n" +
        "            <input name=\"email_" + counter_emails + "\" type=\"text\" placeholder=\"john.s@domen.com\" size=\"18\">";
    document.getElementById('emails').appendChild(div);
}

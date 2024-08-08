
function idElement_err(idElement, err) {
    idElement.text(err);
    idElement.addClass("text-danger");
    idElement.css({ "font-weight": "bold" });
}

async function check_image_exist(name, site, callback) {
    //---
    return new Promise((resolve, reject) => {
        //---
        var url = window.location.origin + '/ncc_to_c/apis/get_img_info.php?' + jQuery.param({ "title": name });
        //---
        $.ajax({
            async: true,
            url: url,
            type: "GET",
            dataType: "json",
            success: function (data) {
                // data not empty
                console.log(JSON.stringify(data));
                var item = data.query.pages[0];
                var exists = true;
                if (item.missing) {
                    exists = false;
                    console.log('exists=' + exists);
                }
                var img_url = "";
                if (item.imageinfo) {
                    img_url = item.imageinfo[0].url;
                }
                callback(exists, img_url);
                resolve();
            },
            error: function (data) {
                callback(false, false);
                resolve();
            }
        });
        //---
    });
}

async function find_info(id) {
    var file = $("#name_" + id).text();
    var idElement = $("#" + id);
    //---
    console.log('get File info..' + id);
    //---
    var site = 'nccommons';
    //---
    await check_image_exist(file, site, function (exists, img_url) {
        if (exists) {
            $('#name_' + id).addClass("text-success");
            console.log('File exists..');
            $('#url_' + id).attr("name", "toup").attr("url", img_url).attr("idt", id);
            // start_up(file, img_url, id);
        } else {
            $('#name_' + id).addClass("text-danger");
            console.log('File not exists..');
            idElement_err(idElement, 'File not exists in  ' + site);
        }
    });
}

async function do_files() {

    const files = $(".files");

    for (let i = 0; i < files.length; i++) {
        var id = files[i].textContent;
        console.log("#" + id);
        //---
        await find_info(id);
    }

}

/*

*/

function vote(score, news)
{
    var output = '';
    $.ajax({
        type: 'POST',
        url:  'functions.php',
        data: ('inqvoting=1&inqscore=' + score + '&idnews=' + news),
        success:function(state){
            var swap = state.split("|");

            if (swap.length > 0){
                for (i = 1; i < 6; i++)
                {
                    output += '<a href="javascript:vote(' + i + ',' + news + ')">';
                    if (i <= score)
                        output += '<span class="glyphicon glyphicon-star';
                    else
                        output += '<span class="glyphicon glyphicon-star-empty';
                    
                    output += ' text-warning"></span></a>';
                }

                document.getElementById('inq'+news).innerHTML = output;
                //document.getElementById('inqcar'+news).innerHTML = output;

                document.getElementById('rat'+news).innerHTML = swap[1];
                //document.getElementById('ratcar'+news).innerHTML = swap[1];

                document.getElementById('rev'+news).innerHTML = swap[0];
                //document.getElementById('revcar'+news).innerHTML = swap[0];
                win = new Window;
            }
        }
    });
}

function likes(news)
{
    $.ajax({
        type: 'POST',
        url:  'functions.php',
        data: ('inslike=1&idnews=' + news),
        success:function(size){
            document.getElementById('lik'+news).innerHTML = '<span class="badge">' + size + '</span>';
        }
    });
}

function share(news)
{
    $.ajax({
        type: 'POST',
        url:  'functions.php',
        data: ('insshare=1&idnews=' + news),
        success:function(size){
            document.getElementById('sha'+news).innerHTML = '<span class="badge">' + size + '</span>';
        }
    });
}


function review(news)
{
    $.ajax({
        type: 'POST',
        url:  'functions.php',
        data: ('reviews=1&idnews=' + idnews),
        success:function(values){
            document.getElementById('rev'+news).innerHTML = values;
        }
    });
}
//var http = require('http');

function follow(url, cb) {
    http.get(url, function(res) {
        res.on('data', function (chunk) {
          var data = JSON.parse(chunk.toString());
          if (!data || !data.follow) {
              cb(data);
              return;
          }
          follow(data.follow.replace('challenge?', 'challenge.json?'), cb);
        });
    });
}

follow('http://letsrevolutionizetesting.com/challenge.json', function (data) {
    console.log(data.message);
});


x='http://letsrevolutionizetesting.com/challenge';
while :;
do r=`curl -s -H "Accept: application/json" $x`;
x=`echo $r | grep -E -o 'http[^"]+'`;
if ! echo "$x" | grep -q http;
then echo $r;
break;
fi;
echo $x;
done

<!DOCTYPE html>
<html>
<body>

<h1>Getting server updates</h1>
<h1>Name:
    <div id="result"></div>
</h1>


<script >
    const source = new EventSource('{{route('notifications')}}',{withCredentials: true});

    source.onmessage = function (event) {
        document.getElementById("result").innerHTML = event.data;
        // source.close();
        // console.log(event.data);
    };
    // source.onopen = function() {
    //     console.log('connection to stream has been opened');
    // };
</script>

</body>
</html>

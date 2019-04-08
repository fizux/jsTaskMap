# jsTaskPlan
Glider pilots frequently use computer based maps showing approved turning points and controlled airspace for planning cross-country flights.

Commercial programs are available for the purpose, but  run only on Windows.  Maintenance of airspace and turning point data has to be done at client level.

*jsTaskPlan* is a viewer written in JavaScript and HTML 5, which will run in any modern Web browser. It uses
 an interactive map, using Google Maps, and obtains controlled airspace data and standardised turning point locations from a variety of publicly available sources.
 
 The user plans the task interactively by clicking on marker icons on the map.

 Currently it is only useable on larger screens (1100 px plus width) with a conventional mouse.  It is intended to add touchscreen and tablet support as a further development.

jsTaskPlan has been tested in the following browsers:
* Firefox 42  (Windows and Linux versions)
* Chromium 45 on Linux
*Chrome 46 on Windows
*Microsoft Edge
* Internet Explorer 11

<hr/>

**Docker**<br/>
You must obtain a Google Maps API token for this to work.
A token may be obtained here:  https://developers.google.com/maps/documentation/javascript/get-api-key

The container expects that you will set the `gmaps_api_token` environment variable, which may be done in the Dockerfile,
in the `docker run` command with `-e / --env` options, or in the docker-compose.yaml file.

Be advised that if you expose this to a public facing port, without authentication, anyone on the internet can run up
your token's traffic count that is tied to your credit card. The authors are not responsible for the charges as a result
of your decision to provide the use of your token to the entire soaring community.

_HTTPS and SSL/TLS certificates_<br/>
The usual use case of this project is behind a reverse proxy that handles all the SSL stuff. 
A simple way to get started is with https://hub.docker.com/r/jwilder/nginx-proxy and obtain a letsencrypt certificate
for your domain.
var context = new AudioContext();
var request = new XMLHttpRequest();
var url = 'sound/Hoppipolla.mp3';
var sourceBuffer = null;
var sourceJs;
var analyser;
var source;
var data;
var boost = 0;
request.open('GET', url, true);
request.responseType = 'arraybuffer';

request.onload = function () {
    context.decodeAudioData(
        request.response,
        function (buffer) {
            sourceJs = context.createScriptProcessor(2048);

            sourceJs.buffer = buffer;
            sourceJs.connect(context.destination);
            analyser = context.createAnalyser();
            analyser.smoothingTimeConstant = 0.6;
            analyser.fftSize = 512;

            source = context.createBufferSource();
            source.buffer = buffer;

            source.connect(analyser);
            analyser.connect(sourceJs);
            source.connect(context.destination);

            sourceJs.onaudioprocess =  function(e) {
                data = new Uint8Array(analyser.frequencyBinCount);
                analyser.getByteFrequencyData(data);
                boost = 0;
                for (var i = 0; i < data.length; i++) {
                    boost += data[i];
                }
                boost = boost / data.length;
            };

            source.start(0);
        }
    );
};

var width = $(window).width();
var height = $(window).height();
var aspect = width/ height;
var scene = new THREE.Scene();

var camera = new THREE.PerspectiveCamera( 65,  aspect, 0.1, 1000 );
camera.position.z = 10;

var renderer = new THREE.WebGLRenderer({ antialias: true } );
renderer.setClearColor(new THREE.Color(0x221f26, 1.0));
renderer.setSize( width, height );

document.body.appendChild( renderer.domElement );

var radius=5;
var obj_resolution =360;
var obj = new THREE.Line(new THREE.Geometry(),new THREE.LineBasicMaterial({color:0xf9f9f9}));

for (var i = 0; i <=  obj_resolution; i++) {
    var angle=Math.PI/180*i;
    var x = (radius) * Math.cos(angle);
    var y = (radius) * Math.sin(angle);
    var z=0;
    obj.geometry.vertices.push(new THREE.Vector3(x, y, z));
}

scene.add(obj);

var count = 0;
var loop = function loop() {
    count++;
    updateCircle();
    requestAnimationFrame(loop);
    renderer.render(scene, camera);
};

function updateCircle() {
    radius = boost * .03;
    var new_poistions=[];

    for (var i = 0; i <=  obj_resolution; i++) {
        var angle=Math.PI/180*i;
        var x = (radius) * Math.cos(angle);
        var y = (radius) * Math.sin(angle);
        var z=0;
        new_poistions.push(new THREE.Vector3(x, y, z));
    }
    obj.geometry.vertices = new_poistions;
    obj.geometry.verticesNeedUpdate = true;
    // obj.material.color.setHex(Math.floor(Math.random() * 16777215).toString(16));
}

request.send();
loop();


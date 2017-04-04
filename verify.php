<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Firebase คืออะไร เริ่มใช้งาน Firebase เบื้องต้น</title>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.8/angular.js"></script>
        <script src="https://www.gstatic.com/firebasejs/3.4.0/firebase.js"></script>
        <script>
            // Initialize Firebase
            var firebaseRef = {};
 
            angular.module('firebaseApp', []).service('firebaseService', function() {
                // สร้าง Function เพื่อ init Firebase เข้ากับ app เรา
                this.initFirebase = function() {
                    var config = {
                       apiKey: "AIzaSyCgazuki31XCNcXeuPUCjzxqJ9G5xlxzbU",
                       authDomain: "esp8266-temp.firebaseapp.com",
                       databaseURL: "https://esp8266-temp.firebaseio.com",
                       projectId: "esp8266-temp",
                       storageBucket: "esp8266-temp.appspot.com",
                       messagingSenderId: "975049663148"
                    };
                    firebase.initializeApp(config);
                    firebaseRef = firebase.database().ref("blogs");
                }
                // สร้าง Function เพื่อเก็บ event ของ Firebase
                this.eventFirebase = function() {
                    firebaseRef.on('value', function(data) {
                        var elementOL = angular.element(document.getElementById('blogs'));
                        console.log(data.val());
                        const datas = data.val();
                        elementOL.empty();
                        angular.forEach(datas, function(post, index) {
                            console.log(' title ::==' + post.title + ' content ::==' + post.content);
                            elementOL.append('<li> Title ::== ' + post.title + ' Content ::==' + post.content + '</li>');
                        })
                    })
                }
                this.push = function(title, content) {}
            }).controller('firebaseCtrl', function(firebaseService) {
                // เรียกใช้งาน firebaseService ที่เราสร้างไว้
                firebaseService.initFirebase();
                firebaseService.eventFirebase();
            })
        </script>
    </head>
    <body ng-app="firebaseApp">
        <div ng-controller="firebaseCtrl">
            <fieldset>
                <legend>Poolsawat 's Blogs</legend>
                <ol id="blogs">
                    <li></li>
                </ol>
            </fieldset>
        </div>
    </body>
</html>

<p align="center">
    <a href="https://en.wikipedia.org/wiki/Tic-tac-toe" target="_blank">
        <img src="https://www.crushpixel.com/big-static18/preview4/tic-tac-toe-game-linear-2806278.jpg" width="400"></a></p>

## Backend TEST 

This is the backend of a Tic-Tac-Toe game:

Request : 

The backend will be used by a frontend built by a separate team, but they have
provided us with a set of product level requirements that we must meet, exposed as
an API. The requirements are as follows:
<ol>
<li>Need an endpoint to call to start a new game. The response should give me
some kind of ID for me to use in other endpoints calls to tell the backend what
game I am referring to.</li>
<li>Need an endpoint to call to play a move in the game. The endpoint should take
as inputs the Game ID (from the first endpoint), a player number (either 1 or 2),
and the position of the move being played. The response should include a data
structure with the representation of the full board so that the UI can update
itself with the latest data on the server. The response should also include a flag
indicating whether someone has won the game or not and who that winner is if
so.</li>
<li>The endpoint that handles moves being played should perform some basic
error handling to ensure the move is valid, and that it is the right players turn
(ie. a player cannot play two moves in a row, or place a piece on top of another
player’s piece)</li>
</ol>

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## INSTALLATION

<ol>
<li>Clone the project</li>
<li>Run composer install</li>
<li>rename .env.example to .env</li>
<li>set mysql configuration in .env</li>
<li>create db</li>
<li>run migration (php artisan migrate) to generate db schema</li>    
</ol>

## EXECUTION

<ul>
<li>curl --location --request POST 'http://localhost:8000/api/start-new-game' <br/><b>Returns Game ID</b></li>
<li>curl --location --request PUT 'http://localhost:8000/api/play-game-turn' \ --header 'Content-Type: application/json' \ --data-raw '{ "id" : RETURNED ID POSITION, "player" : 1 OR 2 (1 START GAME), "position": 1 TO 9 }'</li>
<li>rename .env.example to .env</li>
<li>set mysql configuration in .env</li>
<li>create db</li>
<li>run migration (php artisan migrate) to generate db schema</li>    
</ul>


## EXAMPLE OF GAME

<ul>
<li>curl --location --request POST 'http://localhost:8000/api/start-new-game' <br/><b>Returns 1</b></li>
<li>curl --location --request PUT 'http://localhost:8000/api/play-game-turn' --header 'Content-Type: application/json' --data-raw '{
    "id" : 1,
    "player" : 1,
    "position": 1
}'</li>
<li>curl --location --request PUT 'http://localhost:8000/api/play-game-turn' --header 'Content-Type: application/json' --data-raw '{
    "id" : 1,
    "player" : 2,
    "position": 4
}'</li>
<li>curl --location --request PUT 'http://localhost:8000/api/play-game-turn' --header 'Content-Type: application/json' --data-raw '{
    "id" : 1,
    "player" : 1,
    "position": 2
}'</li>
<li>curl --location --request PUT 'http://localhost:8000/api/play-game-turn' --header 'Content-Type: application/json' --data-raw '{
    "id" : 1,
    "player" : 2,
    "position": 5
}'</li>
    <li>curl --location --request PUT 'http://localhost:8000/api/play-game-turn' --header 'Content-Type: application/json' --data-raw '{
    "id" : 1,
    "player" : 1,
    "position": 3
}'</li>
</ul>
# PLAYER 1 WIN

<ul>
<li>curl --location --request POST 'http://localhost:8000/api/start-new-game' <br/><b>Returns 2</b></li>
<li>curl --location --request PUT 'http://localhost:8000/api/play-game-turn' --header 'Content-Type: application/json' --data-raw '{
    "id" : 2,
    "player" : 1,
    "position": 1
}'</li>
<li>curl --location --request PUT 'http://localhost:8000/api/play-game-turn' --header 'Content-Type: application/json' --data-raw '{
    "id" : 2,
    "player" : 2,
    "position": 1
}'</li>
</ul>
# ERROR POSITION ALREADY TAKEN

<ul>
<li>curl --location --request POST 'http://localhost:8000/api/start-new-game' <br/><b>Returns 3</b></li>
<li>curl --location --request PUT 'http://localhost:8000/api/play-game-turn' --header 'Content-Type: application/json' --data-raw '{
    "id" : 3,
    "player" : 2,
    "position": 1
}'</li>
</ul>
# ERROR WRONG TURN


<ul>
<li>curl --location --request POST 'http://localhost:8000/api/start-new-game' <br/><b>Returns 4</b></li>
<li>curl --location --request PUT 'http://localhost:8000/api/play-game-turn' --header 'Content-Type: application/json' --data-raw '{
    "id" : 4,
    "player" : 1,
    "position": 1
}'</li>
<li>curl --location --request PUT 'http://localhost:8000/api/play-game-turn' --header 'Content-Type: application/json' --data-raw '{
    "id" : 4,
    "player" : 2,
    "position": 1
}'</li>
</ul>
# ERROR POSITION ALREADY TAKEN

<ul>
<li>curl --location --request POST 'http://localhost:8000/api/start-new-game' <br/><b>Returns 5</b></li>
<li>curl --location --request PUT 'http://localhost:8000/api/play-game-turn' --header 'Content-Type: application/json' --data-raw '{
    "id" : 5,
    "player" : 1,
    "position": 1
}'</li>
<li>curl --location --request PUT 'http://localhost:8000/api/play-game-turn' --header 'Content-Type: application/json' --data-raw '{
    "id" : 5,
    "player" : 2,
    "position": 2
}'</li>
<li>curl --location --request PUT 'http://localhost:8000/api/play-game-turn' --header 'Content-Type: application/json' --data-raw '{
    "id" : 5,
    "player" : 1,
    "position": 3
}'</li>
<li>curl --location --request PUT 'http://localhost:8000/api/play-game-turn' --header 'Content-Type: application/json' --data-raw '{
    "id" : 5,
    "player" : 2,
    "position": 5
}'</li>
<li>curl --location --request PUT 'http://localhost:8000/api/play-game-turn' --header 'Content-Type: application/json' --data-raw '{
    "id" : 5,
    "player" : 1,
    "position": 4
}'</li>
<li>curl --location --request PUT 'http://localhost:8000/api/play-game-turn' --header 'Content-Type: application/json' --data-raw '{
    "id" : 5,
    "player" : 2,
    "position": 7
}'</li>
<li>curl --location --request PUT 'http://localhost:8000/api/play-game-turn' --header 'Content-Type: application/json' --data-raw '{
    "id" : 5,
    "player" : 1,
    "position": 6
}'</li>
<li>curl --location --request PUT 'http://localhost:8000/api/play-game-turn' --header 'Content-Type: application/json' --data-raw '{
    "id" : 5,
    "player" : 2,
    "position": 9
}'</li>
<li>curl --location --request PUT 'http://localhost:8000/api/play-game-turn' --header 'Content-Type: application/json' --data-raw '{
    "id" : 5,
    "player" : 1,
    "position": 8
}'</li>
</ul>
#GAME ENDED WITH NO WINNER


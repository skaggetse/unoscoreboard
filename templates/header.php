<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uno API</title>
    <style>
        body {
            font-family: 'comic sans ms';
            font-size: 14px;
            background: url( '/assets/images/bg.png' );
        }
        ul {
            padding: 0;
            margin: 0;
        }
        li {
            margin-left: 25px;
            display: inline;
            list-style-type: none;
        }
        td {
            text-align: center;
        }
        
        #scoreboard {
            border-collapse: collapse;
        }
        #scoreboard tr:nth-child(4n+2) {
            background: rgba( 255,0,0,0.1);
        }
        #scoreboard tr:nth-child(4n+3) {
            background: rgba( 0,255,0,0.1);
        }
        #scoreboard tr:nth-child(4n+4) {
            background: rgba( 0,0,255,0.1);
        }
        #scoreboard tr:nth-child(4n+5) {
            background: rgba( 255,255,0,0.1);
        }
    </style>
</head>
<body>
    <table width="1024px">
        <tr>     
            <td colspan=2>
                <img src="/assets/images/uno-plusfour.gif" height="175px">
            </td>
            <td colspan=8>
                <table width="100%">                               
                    <tr>
                        <td><h1>Bravomedia UNO Scoreboard</h1></td>
                    </tr>
                    <tr>
                        <td>                
                            <ul>
                                <li>
                                    <a href="/scoreboard">Scoreboard</a>
                                </li>
                                <li>
                                    <a href="/games">Games</a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                </table>
            </td>
            <td colspan=2>
                <img src="/assets/images/uno-hand.gif"height="175px">
            </td>
        </tr>
        <tr>
            <td colspan=2>
            </td>
            <td colspan=8>
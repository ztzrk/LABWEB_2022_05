var sum = [];
var deck = [];
var cash = 5000;
var gameON = true;
var win = false;
createDeck();

function setBet() {
    let x = document.getElementById("js-bet").value;
    document.getElementById("valid").style.display = 'none';
    
    let text;
    if (isNaN(x) || (x.trim() == '' ) || (x == null)) {
        text = "Make sure your input is number";
        document.getElementById("valid").innerHTML = text;
        document.getElementById("valid").style.display = 'block';
    }
    else if(x <= 0) {
        text = "Make sure your input is positive number";
        document.getElementById("valid").innerHTML = text;
        document.getElementById("valid").style.display = 'block';
    }
    else if(x > cash) {
        text = "Make sure your input is not too much";
        document.getElementById("valid").innerHTML = text;
        document.getElementById("valid").style.display = 'block';
    }
    else {
        cash = cash - parseInt(x);
        document.getElementById('cash').innerHTML = 'Cash = $' + cash;
        document.getElementById('bet-menu').style.display = 'none';
        document.getElementById('play-menu').style.display = 'block';
        var rdmcrd = randomCard();
        sum[0] = rdmcrd[0];
        createCard(rdmcrd);
        rdmcrd = randomCard();
        sum[1] = rdmcrd[0];
        createCard(rdmcrd);
        sumCard();
        check21();
        gameOver();
        document.getElementById('cardSum').innerHTML = deck.length + " cards left";
        document.getElementById('sum').innerHTML = 'Sum of Cards = ' + sumCard();
    }
}


function createDeck() {
    var suits = ['spade', 'club', 'heart', 'diamond']
    var num = ['1','2','3','4','5','6','7','8','9','10','11','12','13'];
    var index = 0;
    for (let i = 0; i < num.length; i++) {
        for (let j = 0; j < suits.length; j++) {
            const e1 = num[i];
            const e2 = suits[j];
            const card = [`${e1}`,`${e2}`]
            deck[index] = card;
            index++;
        }
    }
}

function randomCard() {
    const randomIndex = Math.floor(Math.random() * deck.length);
    const card = deck[randomIndex];
    deck.splice(randomIndex, 1);
    return card;
}

function createCard(num) {
    if (num[0] == '1') {
        num[0] = "A";
    }
    else if (num[0] == '11') {
        num[0] = "J";
    }
    else if (num[0] == '12') {
        num[0] = "Q";
    }
    else if (num[0] == '13') {
        num[0] = "K";
    }

    var div1 = document.createElement('div');
    div1.className = 'card';
    var div2 = document.createElement('div');
    div2.className = 'card-body';
    var h1 = document.createElement('h1');
    h1.className = 'card-title';
    h1.innerHTML = num[0];
    var icon = document.createElement('i');
    icon.className = `bi bi-suit-${num[1]}-fill h1`;
    var h1Bot = document.createElement('h1');
    h1Bot.className = 'bottom';
    h1Bot.innerHTML = num[0];
    div2.appendChild(h1);
    div2.appendChild(icon);
    div2.appendChild(h1Bot);
    div1.appendChild(div2);
    
    document.getElementById("card-collection").appendChild(div1);
}

function sumCard() {
    let totalSum = 0;
    let isAce = false;
    for (let i = 0; i < sum.length; i++) {
        const element = parseInt(sum[i]);
        if (element == 11 ||element == 12 || element == 13) {
            totalSum += 10;
        }
        else if (element == 1) {
            totalSum += 1;
            isAce = true;
        }
        else {
            totalSum += element;
        }
    }
    if (isAce && totalSum + 10 <= 21) {
        return totalSum + 10;
    }
    else {
        return totalSum;
    }
}

function check21() {
    let totalSum = sumCard();
    if (totalSum >= 21) {
        gameON = false;
    }
    else {
        gameON = true;
    }
    console.log(gameON)
}

function hitCard() {
    var rdmcrd = randomCard();
    sum.push(rdmcrd[0]);
    createCard(rdmcrd);
    sumCard();
    document.getElementById('sum').innerHTML = 'Sum of Cards = ' + sumCard();
    document.getElementById('cardSum').innerHTML = deck.length + " cards left";
    check21();
    gameOver();
}

function gameOver() {
    if (gameON) {
        document.getElementById("btn-play-again").disabled = true;
    }
    else {
        document.getElementById("btn-play-again").disabled = false;
        document.getElementById("btn-take-card").disabled = true;
        if (sumCard() > 21) {
            document.getElementById('winMsg').innerHTML = "You lose";
        }
        else {
            document.getElementById('winMsg').innerHTML = "Congrats you win, take this money";
            cash = cash + (parseInt(document.getElementById("Bet").value) * 5);
            document.getElementById('cash').innerHTML = 'Cash = $' + cash;
        }
    }
}

function playAgain() {
    document.getElementById('bet-menu').style.display = 'block';
    document.getElementById('play-menu').style.display = 'none';
    const list = document.getElementById("card-collection");

    while (list.hasChildNodes()) {
        list.removeChild(list.firstChild);
    }
    document.getElementById('winMsg').innerHTML = "";
    document.getElementById("btn-take-card").disabled = false;
    sum = [];
    gameON = true;
}
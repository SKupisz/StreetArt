let viewsStats = ["0","0","0","0","0"];
function loadChart(){
    let statsColumnsList = document.getElementsByClassName("stats-column");
    let theHighest = 0,theHighestLikes = 0;
    for(let i = 0 ; i < statsColumnsList.length; i++)
    {
        let takeTheQuantity = statsColumnsList[i].id;
        takeTheQuantity = takeTheQuantity.substring(6,takeTheQuantity.length);
        takeTheQuantity = parseInt(takeTheQuantity);
        if(i < 5)
        {
            if(theHighest < takeTheQuantity)
            {
                theHighest = takeTheQuantity;
            }    
        }
        else
        {
            if(theHighestLikes < takeTheQuantity)
            {
                theHighestLikes = takeTheQuantity;
            }             
        }
    }
    for(let i = 0; i < statsColumnsList.length; i++)
    {
        let takeTheQuantity = statsColumnsList[i].id;
        takeTheQuantity = takeTheQuantity.substring(6,takeTheQuantity.length);
        takeTheQuantity = parseInt(takeTheQuantity);
        let childTable = statsColumnsList[i].children;
        if(i < 5)
        {
            if(theHighest == 0){
                childTable[0].style.height = "1px";
                childTable[1].style.height = "99px";
            }
            else
            {
                childTable[0].style.height = ((takeTheQuantity/theHighest)*100)+"px";
                childTable[1].style.height = (((theHighest - takeTheQuantity)/theHighest)*100)+"px";
            }

        }
        else
        {
            childTable[0].style.height = ((takeTheQuantity/theHighestLikes)*100)+"px";
            childTable[1].style.height = (((theHighest - takeTheQuantity)/theHighestLikes)*100)+"px";
        }

        if(childTable[0].style.height == "0px"){
            childTable[0].style.height = "1px";
            childTable[1].style.height = "99px";
        }
        var forPrepare = takeTheQuantity.toString();
        viewsStats[i] = forPrepare;
        /*let newColumn = new Vue({
            el: ".column"+(i+1),
            data: {
                message: forPrepare
            }
        });*/
    }
}
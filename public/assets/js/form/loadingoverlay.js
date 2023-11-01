


// Auto Ajax Loading Call
// $(document).ajaxStart(function(){
//     $.LoadingOverlay("show");
// });
// $(document).ajaxStop(function(){
//     $.LoadingOverlay("hide");
// });
// End
    

// Full Page Loading
function showFullPageLoading(){
    $.LoadingOverlay("show", {
        image       : "",
        fontawesome : "spinnerDesign fas fa-spinner fa-spin"
    });
} //showFullPageLoading

function hideFullPageLoading(){
    $.LoadingOverlay("hide");
} //hideFullPageLoading




// DOM Element Loading
function showDomLoading(e){

    if($(e).is(':visible')){
            
        if (e.length) {


            // Start

            function calculateVisibilityForDiv(parentDiv, overlyDiv) {
                var parentDivHeight = parentDiv.height(),
                    parentDivWidth = parentDiv.width(),
                    parentDivTop = parentDiv.scrollTop(),
                    parentDivLeft = parentDiv.scrollLeft(),
                    overlyDivPosY = overlyDiv.offset().top,
                    overlyDivPosX = overlyDiv.offset().left,
                    overlyDivHeight = overlyDiv.height(),
                    overlyDivWidth = overlyDiv.width();
                    
        
                // console.log('parentDivHeight -'+ parentDivHeight);
                // console.log('parentDivWidth -'+ parentDivWidth);
                // console.log('parentDivTop -'+ parentDivTop);
                // console.log('parentDivLeft -'+ parentDivLeft);
                // console.log('overlyDivPosY -'+ overlyDivPosY);
                // console.log('overlyDivPosX -'+ overlyDivPosX);
                // console.log('overlyDivHeight -'+ overlyDivHeight);
                // console.log('overlyDivWidth -'+ overlyDivWidth);
                // console.log('hiddenBefore -'+ hiddenBefore);
                // console.log('hiddenAfter -'+ hiddenAfter);
                    
                var totalWidthOfDiv = overlyDivWidth+overlyDivPosX;
                var widthShowingPercentage = (totalWidthOfDiv*100)/parentDivWidth;

                // console.log(parentDivWidth);
                // console.log(totalWidthOfDiv);
                // console.log(widthShowingPercentage);
                // console.log("---");

                if(Number(widthShowingPercentage) > 100){
                    return 0;
                }else{
                    return 1;
                }



            }

            // Based on the Parent div show or hide the overly 
            // If the div Hiddem within the parent div width or height it wont show the loading overly
            var showOverly = 1;
            if($(e).parents('.overlyContainerLimit').length){
                var overlyContainerLimit = $(e).parents('.overlyContainerLimit');
                showOverly = calculateVisibilityForDiv(overlyContainerLimit, $(e) );
            }

            // End
            if(showOverly == 1){
                
                e.LoadingOverlay("show", {
                    image       : "",
                    fontawesome : "spinnerDesign fas fa-spinner fa-spin",
                });

            }else{
                e.LoadingOverlay("show", {
                    image       : "",
                    fontawesome : "spinnerDesign",
                });
            } // Show overly IF End
            
    
        }
    } // Visible Check

} //showDomLoading

function hideDomLoading(e){
    if (e.length) {
        e.LoadingOverlay("hide");
    }
    
} //hideDomLoading



// let body = $('body');
// showDomLoading(body);
// showFullPageLoading()
// hideDomLoading(body);

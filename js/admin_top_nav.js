/**
 * Created by lenovo on 2016/7/23.
 */
function admin_top_nav(j){
    for(i=1;i<5;i++){
        document.getElementById('nav'+i).style.backgroundPosition = 'left bottom';
        document.getElementById('nav'+i).style.color = '#ffffff';
    }
    document.getElementById('nav'+j).style.backgroundPosition = 'right bottom';
    document.getElementById('nav'+j).style.color = '#3b6ea5';
}
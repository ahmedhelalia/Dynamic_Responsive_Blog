const NAVITEMS = document.querySelector('.nav__items');
const OPENNAVBTN = document.querySelector('#open__nav-btn');
const CLOSENAVBTN = document.querySelector('#close__nav-btn');

// OPENS NAV DROP DOWN
const openNav = () => {
    NAVITEMS.style.display = 'flex';
    OPENNAVBTN.style.display = 'none';
    CLOSENAVBTN.style.display = 'inline-block';
}
// Close Drop Down NAV
const closeNav = () => {
    NAVITEMS.style.display = 'none';
    OPENNAVBTN.style.display = 'inline-block';
    CLOSENAVBTN.style.display = 'none';
}

OPENNAVBTN.addEventListener('click',openNav);
CLOSENAVBTN.addEventListener('click',closeNav);


const SIDEBAR = document.querySelector('aside');
const SHOWSIDEBARBTN = document.querySelector('#show__sidebar-btn');
const HIDESIDEBARBTN = document.querySelector('#hide__sidebar-btn');
// shows sidebar on small devices
const showSideBar = () =>{
    SIDEBAR.style.left = '0';
    SHOWSIDEBARBTN.style.display = 'none';
    HIDESIDEBARBTN.style.display = 'inline-block';
}
// shows sidebar on small devices
const hideSideBar = () =>{
    SIDEBAR.style.left = '-100%';
    SHOWSIDEBARBTN.style.display = 'inline-block';
    HIDESIDEBARBTN.style.display = 'none';
}

SHOWSIDEBARBTN.addEventListener('click',showSideBar);
HIDESIDEBARBTN.addEventListener('click',hideSideBar);
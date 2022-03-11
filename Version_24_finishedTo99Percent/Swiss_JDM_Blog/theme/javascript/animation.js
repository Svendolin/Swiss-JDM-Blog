
// Register plugin once:
gsap.registerPlugin(MotionPathPlugin);





/// --- 2) Timeline to let the leaves fall --- ///
const leaves = gsap.timeline()//.pause()





leaves
.to('.firstLeaf',  {
    motionPath: {
    path: [
      {x:-50, y:230}, 
      {x:-100, y:230}, 
      {x:-80, y:210},
      {x:-60, y:220},
      {x:-60, y:250},
      {x:-100, y:350},
    ],
  },
  duration: 6,
  curviness: 8,
  repeat: -1,
  repeatDelay: 7, 
  yoyo: false,
  rotation: 3500,
  xPercent: -50,  
  yPercent: -50,
  ease: "power1",
}) //.pause()
.to('.secondLeaf', {
  motionPath: {
  path: [
    {x:-200, y:200}, 
    {x:-400, y:340},
  ],
},
duration: 4,    // Leaf falls in 4 seconds
curviness: 0,  
repeat: -1,     // Infinite repeat
repeatDelay: 4, // 4 Second Delay after every Repeat
yoyo: false,    // A,B,A,B - Scheme
rotation: 2900, 
xPercent: -50,  // Placed in the middle of the path line
yPercent: -50,
ease: "power1.in",  
}, '<2')
.to('.thirdLeaf', {
  motionPath: {
  path: [
    {x:-70, y:100},
     {x:-190, y:180}, 
     {x:-220, y:280},
    ],
},
duration: 5,    
curviness: 3,   
repeat: -1,     
yoyo: false,    
rotation: 2000, 
xPercent: -50,  
yPercent: -50,
ease: "power1.out",
delay: 2,        // Little starting delay of 2 Seconds before the animation starts
})
.to('.fourthLeaf', {
  motionPath: {
  path: [
    {x:-20, y:100}, 
    {x:-100, y:200}, 
    {x:-50, y:300},
  ],
},
duration: 5,    
curviness: 3,   
repeat: -1,
repeatDelay: 2,     
yoyo: false,    
rotation: 2000, 
xPercent: -50,  
yPercent: -50,
delay: 4,
})
.to('.fifthLeaf', {
  motionPath: {
  path: [
    {x:-290, y:100}, 
    {x:-390, y:200}, 
    {x:-590, y:300},
  ],
},
duration: 6,    
curviness: 3,   
repeat: -1,
repeatDelay: 4,      
yoyo: false,    
rotation: 4000, 
xPercent: -50,  
yPercent: -50,
delay: 4,
ease: "power1.out",
});





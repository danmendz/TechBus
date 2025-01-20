import * as THREE from 'https://cdn.skypack.dev/three@0.129.0/build/three.module.js';
import { GLTFLoader } from 'https://cdn.skypack.dev/three@0.129.0/examples/jsm/loaders/GLTFLoader.js';
import { gsap } from 'https://cdn.skypack.dev/gsap';

const scene = new THREE.Scene();

// Camera setup
const camera = new THREE.PerspectiveCamera(
    50,
    window.innerWidth / window.innerHeight,
    0.1,
    1000
);
camera.position.set(5, 2, 30);

// Renderer setup
const renderer = new THREE.WebGLRenderer({ alpha: true });
renderer.setSize(window.innerWidth, window.innerHeight);
document.getElementById('container3D').appendChild(renderer.domElement);
renderer.setClearColor(0x4e9b, 1);

// Light setup
const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
scene.add(ambientLight);

const topLight = new THREE.DirectionalLight(0xffffff, 0.6);
topLight.position.set(500, 500, 500);
scene.add(topLight);

let object;
let mixer;
const loader = new GLTFLoader();
loader.load(
    '/models/indonesian_bus_ecoline.glb',
    function (gltf) {
        object = gltf.scene;
        object.scale.set(2.5, 2.5, 2.5);

        const box = new THREE.Box3().setFromObject(object);
        const center = box.getCenter(new THREE.Vector3());
        object.position.sub(center);

        
        scene.add(object);
        camera.lookAt(object.position);
        object.position.y = -5;
        object.position.x -= 9.5;
    },
    function (xhr) {},
    function (error) {}
);

// Variables for hover effect
let mouseX = 0;
let mouseY = 0;
let targetX = 0;
let targetY = 0;

// Event listener to detect mouse movement
document.getElementById('container3D').addEventListener('mousemove', (event) => {
    const rect = document.getElementById('container3D').getBoundingClientRect();
    mouseX = (event.clientX - rect.left) / rect.width - 0.5;
    mouseY = (event.clientY - rect.top) / rect.height - 0.5;
});

const reRender3D = () => {
    requestAnimationFrame(reRender3D);

    targetX += (mouseX - targetX) * 0.1;
    targetY += (mouseY - targetY) * 0.1;

    if (object) {
        object.rotation.y = targetX * Math.PI * 0.04; // Rotación en Y
        object.rotation.x = targetY * Math.PI * 0.04; // Rotación en X
    }

    renderer.render(scene, camera);
    if (mixer) mixer.update(0.02);
};

reRender3D();

require("./bootstrap");

import { createApp } from "vue";
import App from "./components/App.vue";
import NProgress from "nprogress";
import "nprogress/nprogress.css";

const app = createApp(App).mount("#app");

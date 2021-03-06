import Vue from 'vue';
import VueRouter from 'vue-router';

import CategoriesComponent from "../components/admin/pages/categories/CategoriesComponent";
import AddCategoryComponent from "../components/admin/pages/categories/AddCategoryComponent";
import EditCategoryComponent from "../components/admin/pages/categories/EditCategoryComponent";
import DashboardComponent from "../components/admin/pages/dashboard/DashboardComponent";
import AdminComponent from "../components/admin/AdminComponent";
import ProductsComponent from "../components/admin/pages/products/ProductsComponent";
import HomeComponent from "../components/frontend/pages/home/HomeComponent";
import SiteComponent from "../components/frontend/SiteComponent";
import ContactComponent from "../components/frontend/pages/contact/ContactComponent";
import ProductDetail from "../components/frontend/pages/product/ProductDetail";

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        component: SiteComponent,
        children: [
            { path: '', component: HomeComponent, name: 'home' },
            { path: '/contact', component: ContactComponent, name: 'contact' },
            { path: 'prooduct/:id', component: ProductDetail, name: 'product.detail', props: true },
        ]
    },
    {
        path: '/admin',
        component: AdminComponent,
        children: [
            { path: '', component: DashboardComponent, name: 'admin.dashboard' },

            { path: 'categories', component: CategoriesComponent, name: 'admin.categories' },
            { path: 'categories/create', component: AddCategoryComponent, name: 'admin.categories.create' },
            { path: 'categories/:id/edit', component: EditCategoryComponent, name: 'admin.categories.edit', props: true },

            { path: 'products', component: ProductsComponent, name: 'admin.products' },
            // { path: 'products', component: ProductsComponent, name: 'admin.products' },
        ]
    },
];

const router = new VueRouter({
    routes
});

export default router;

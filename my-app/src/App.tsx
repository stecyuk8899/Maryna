import React from 'react';
import './App.css';
import {Route, Routes} from "react-router-dom";
import ProductDetailsPage from "./components/product/details/ProductDetailsPage";
import ProductListPage from "./components/product/list/ProductListPage";
import ProductEditPage from "./components/product/edit/ProductEditPage";
import ProductCreatePage from "./components/product/create/ProductCreatePage";
import AddPicturePage from "./components/product/create/addPicture/AddPicturePage";
import CategoryListPage from "./components/category/list/CategoryListPage";
import CategoryCreatePage from "./components/category/create/CategoryCreatePage";
import CategoryEditPage from "./components/category/edit/CategoryEditPage";
import {Layout} from "./components/Layout";

function App() {
  return (
   <>
       <Routes>
           <Route path={"/"} element={<Layout/>}>
               <Route index element={<ProductListPage/>}/>
               <Route path={"product"}>
                   <Route path={"details/:id"} element={<ProductDetailsPage/>}/>
                   <Route path={"create"} element={<ProductCreatePage/>}/>
                   <Route path={"edit/:id"} element={<ProductEditPage/>}/>
                   <Route path={"addPicture/:id"} element={<AddPicturePage/>}/>
               </Route>
               <Route path={"category"}>
                   <Route path={"all"} element={<CategoryListPage/>}/>
                   <Route path={"create"} element={<CategoryCreatePage/>}/>
                   <Route path={"edit/:id"} element={<CategoryEditPage/>}/>
               </Route>
               <Route path="*" element={<h1 className={"text-center"}>Page Not Found!</h1>}/>
           </Route>
       </Routes>
   </>
  );
}

export default App;

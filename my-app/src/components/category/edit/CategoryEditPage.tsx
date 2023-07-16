import {ICategoryEdit} from "./types";
import {useFormik} from "formik";
import {Link, useNavigate, useParams} from "react-router-dom";
import React from "react";
import http_common from "../../../http_common";

const CategoryEditPage = () => {
    const {id} = useParams();
    const init : ICategoryEdit = {
        id: 0,
        name: "",
        image: "",
        description: ""
    };

    const navigate = useNavigate();
    const onFormikSubmit = async (values: ICategoryEdit) => {
        try {
            await http_common.post(`api/category/edit/${id}`, values);
            navigate(`/category/all`);
        } catch (error) {
            console.log(error);
        }
    }

    const formik = useFormik({
        onSubmit: onFormikSubmit,
        initialValues: init
    });
    const {values, handleChange, handleSubmit} = formik;

    return (
        <>
            <div className="card text-center">
                <div className="card-header">
                    <ul className="nav nav-pills card-header-pills containerul">
                        <li className="nav-item">
                            <Link to={`/category/all`} className="nav-link bg-dark active">Назад</Link>
                        </li>
                    </ul>
                </div>
            </div>
            <div className="container">
                <h1 className="text-center">Зміна категорії</h1>
                <form className={"col-md-8 offset-md-2"} onSubmit={handleSubmit}>
                    <div className="mb-3">
                        <label htmlFor="name" className="form-label">Назва</label>
                        <input
                            type="text"
                            className="form-control"
                            id="name"
                            name={"name"}
                            value={values.name}
                            onChange={handleChange}
                        />
                    </div>
                    <div className="mb-3">
                        <label htmlFor="image" className="form-label">Фото</label>
                        <input
                            type="text"
                            className="form-control"
                            id="image"
                            name={"image"}
                            value={values.image}
                            onChange={handleChange}
                        />
                    </div>

                    <div className="mb-3">
                        <label htmlFor="description" className="form-label">Опис</label>
                        <input
                            type="text"
                            className="form-control"
                            id="description"
                            name={"description"}
                            value={values.description}
                            onChange={handleChange}
                        />
                    </div>
                    <button type="submit" className="btn btn-primary">Зберегти</button>
                </form>
            </div>
        </>
    );
}

export default CategoryEditPage;
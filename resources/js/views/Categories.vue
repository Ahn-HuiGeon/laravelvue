<template>
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <router-link to="/"> 메인페이지</router-link>
            </li>
            <li class="breadcrumb-item active">게시판</li>
        </ol>

        <div class="card mb-3">
            <div class="card-header d-flex">
                <span>
                    <i class="fas fa-chart-area"></i>
                    게시판 관리
                </span>
                <button class="btn btn-primary btn-sm ml-auto" v-on:click="showNewCategoryModal"><span class="fa fa-plus"></span> Create New</button>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Image</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(category, index) in categories" :key="index">
                            <td>{{category.id}}</td>
                            <td>{{category.name}}</td>
                            <td>{{category.image}}</td>
                            <td>
                                <button class="btn btn-primary btn-sm"><span class="fa fa-edit"></span></button>
                                <button class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <b-modal ref="newCategoryModal" hide-footer title="Add New Category">
            <div class="d-block">
                <form v-on:submit.prevent="createCategory">
                    <div class="form-group">
                        <label for="name">Enter Name</label>
                        <input type="text" v-model="categoryData.name" class="form-control" id="name"
                        placeholder="Enter category name" />
                        <div class="invalid-feedback" v-if="errors.name">{{errors.name[0]}}</div>
                    </div>
                    <div class="form-group">
                        <label for="image">Choose an image</label>
                        <div v-if="categoryData.image.name">
                            <img src="" ref="newCategoryImageDisplay" class="w-150px" />
                        </div>
                        <input type="file" v-on:change="attachImage" ref="newCategoryImage" class="form-control"
                        id="image" />
                        <div class="invalid-feedback" v-if="errors.image">{{errors.image[0]}}</div>
                    </div>

                    <hr>
                    <div class="text-right">
                        <button type="button" class="btn btn-default" v-on:click="hideNewCategoryModal">Cancel</button>
                        <button type="submit" class="btn btn-primary"><span class="fa fa-check"></span>Save</button>
                    </div>
                </form>
            </div>
        </b-modal>
    </div>
</template>

<script>
import * as categoryService from '../services/category.service';

export default {
    name: 'category',
    data() {
        return {
            categories: [],
            categoryData: {
                name: '',
                image: '',
            },
            errors: {}
        }
    },
    mounted() {
        this.loadCategories();
    },
    methods: {
        loadCategories: async function() {
            // let url = "/api/categories";

            // try {
            //     const response = await categoryService.loadCategories();
            //     console.log("response : ",response);
            //     this.categories = response.data.data;
            // } catch (error) {
            //     console.log(error)
            //     this.flashMessage.error({
            //         message: 'Some error occurred, Please refresh!',
            //         time:5000
            //     });
            // }

            let url = '/api/categories';
            
            try{
                axios.get(url).then(response => {
                    console.log(response);
                    this.categories = response.data.data;
                });
            } catch (error) {
                console.log(error)
                this.flashMessage.error({
                    message: 'Some error occurred, Please refresh!',
                    time:5000
                });
            }
        },
        attachImage(){
            this.categoryData.image = this.$refs.newCategoryImage.files[0];
            let reader = new FileReader();
            reader.addEventListener('load', function(){
                this.$refs.newCategoryImageDisplay.src = reader.result;
            }.bind(this), false);

            reader.readAsDataURL(this.categoryData.image);
        },
        hideNewCategoryModal(){
            this.$refs.newCategoryModal.hide();
        },
        showNewCategoryModal(){
            this.$refs.newCategoryModal.show();
        },
        createCategory: async function(){
            let formData = new FormData();
            formData.append('name', this.categoryData.name);
            formData.append('image', this.categoryData.image);

            try {
                const response = await categoryService.createCategory(formData);
                console.log(response);
                this.hideNewCategoryModal();
                this.flashMessage.success({
                    message: 'Category stored successfully!',
                    time: 5000
                });
            } catch (error) {
                switch(error.response.status){
                    case 422:
                        this.errors = error.response.data.errors;
                        break;
                    default:
                        this.flashMessage.error({
                            message: 'Some error occurred, Please try again!',
                            time: 5000
                        });
                        break;
                }
            }
        }
    }
};
</script>

<style></style>
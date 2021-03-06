import React, { Component } from "react";
import { connect } from "react-redux";

import { getProducts, setProduct ,updateProduct, storeProduct } from "../actions"
import { Loading, NotFound, Table, Form, Page, Show, Text  , Icon} from "../components";

class Product extends Component{

    state = {        
        tab: 0
    };

    componentDidMount(){
        if (this.props.product === null) {
            this.props.getProducts();
        }
    }
    handleClick = () => {
        if (this.props.product.id == 0) {
            this.props.storeProduct(this.props.product)
        } else {
            this.props.updateProduct(this.props.product)
        }
    };

    render(){
        if (this.props.product === null) return <Loading />
        if (this.props.product === undefined) return <NotFound />
        return(
            <Page                
                title={this.props.product.attributes.title}
                button={{
                    label: 'save',
                    onClick:() => this.handleClick()
                }}
                tabs={this.props.product.id === 0 ?['نمایش','افزودن محصول'] :['نمایش', 'ویرایش اطلاعات', 'نظرات']}
                tab={this.state.tab}
                redirect={this.state.redirect}
                loading={this.props.product == null}
                onChange={(tab) => this.setState({tab})}
            >
                <Form show={this.state.tab === 0}>
                    <Show data={[
                        { label: 'نامک',        value: this.props.product.attributes.slug},
                    ]} />
                </Form>
                <Form show={this.state.tab === 1}>
                    <Text
                        label='نام'
                        value={this.props.product.attributes.title}
                        half
                        onChange={ (e) => this.props.setProduct(this.props.product.id, {title: e.target.value}) }
                    />
                    <Text
                        label='نامک'
                        value={this.props.product.attributes.slug}
                        half
                        onChange={ (e) => this.props.setProduct(this.props.product.id, {slug: e.target.value}) }
                    />
                    <Text
                        label='خلاصه'
                        value={this.props.product.attributes.abstract}
                        half
                        onChange={ (e) => this.props.setProduct(this.props.product.id, {abstract: e.target.value}) }
                    />
                    <Text
                        label='توضیحات'
                        value={this.props.product.attributes.body}
                        half
                        onChange={ (e) => this.props.setProduct(this.props.product.id, {body: e.target.value}) }
                    />
                    <Text
                        label='قیمت'
                        value={this.props.product.attributes.price}
                        half
                        type={'number'}
                        onChange={ (e) => this.props.setProduct(this.props.product.id, {price: e.target.value}) }
                    />
                </Form>
                <Form show={this.state.tab === 2}>
                    <Table
                        data={this.props.comments}
                        columns={[
                            {
                                Header: 'id',
                                accessor: 'id',
                                width: 70
                            },
                            {
                                Header: 'وضعیت',
                                width: 50,
                                Cell: row => row.original.oldAttributes? (<Icon icon="edit" />): '',
                            },
                            {
                                Header: 'عنوان',
                                accessor: 'attributes.body',
                            }
                        ]}
                        tdClick={this.tdClick}
                    />
                </Form>
            </Page>
        );
    }
}

const mapStateToProps = (state, props) => {
    return { 
        product: (state.products.index.length)?
            state.products.index.find( element => element.id == props.match.params.product ):
            null,
        comments: state.comments.index
    };
};

export default connect(mapStateToProps, { getProducts ,setProduct , updateProduct , storeProduct })(Product);
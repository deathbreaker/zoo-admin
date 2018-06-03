import React, { Component } from 'react';
import {withRouter} from 'react-router-dom';
import {
    Container,
    Card,
    CardColumns,
    CardImg,
    CardBody,
    CardTitle,
    CardSubtitle,
    CardText,
    Button,
    Row,
    Col,
    CardGroup
} from 'reactstrap';
import { Link } from 'react-router-dom';
import Footer from '../Common/Footer';
import LoaderIn from '../Loader/LoaderIn';
import ajax from '../../utils/ajax';
import Navigation from '../Common/Navigation';
import SearchInput, {createFilter} from 'react-search-input'

const KEYS_TO_FILTERS = ['name', 'latinname', 'count', 'dest.name'];

class List extends Component{

    state = {
        animals: [],
        searchTerm: ''
    };

    componentDidMount() {
        ajax.get("/user/animals")
             .then( response => {
                 const animals = response.data;
                 console.log(animals);
                 this.setState({ animals: animals });
             })
             .catch((error)  => {
                console.log(error)
             });
    }

    onDeleteSubmit = (event, id)  => {
        ajax.delete("/user/animals/" + id )
            .then( () => {
                this.props.history.push("/animals");
            })
            .catch((error)  => {
                console.log(error)
            });
    };

    toggle = () => {
        console.log("uwdhwdah");
        this.setState({
            modal: !this.state.modal
        });
    };

    onPutSubmit = (id) => {
        console.log(id);
        const {name, latinname} = this.state;
        return  ajax.patch('/user/animals/' + id, {name, latinname})
                    .then(() => {
                        this.props.history.push('/animals');
                    })
                    .catch((err) => {
                        console.log(err)
                    });
    };

    searchUpdated = (term) => {
        this.setState({searchTerm: term})
    };


    render(){
        const defaultImageUrl = 'http://www.zoozlin.eu';
        console.log( this.props.isAdmin);
        const animals = this.state.animals;
        let isLoading = !animals.length ;
        const imageStyle = "border border-circle";
        const noAnimalImageStyle = " bg-success no-animal-image";
        const noImage = "/fassets/images/seznam-zvirat/empty.jpg";

        const noAnimalImage =
            <div className={imageStyle + noAnimalImageStyle}>
                <span className="animal-icon text-center text-green ra ra-lion ra-rw"></span>
            </div>
        ;
        const filteredAnimals = animals.filter(createFilter(this.state.searchTerm, KEYS_TO_FILTERS ));


        if(isLoading){
            return <LoaderIn/>
        }

        //console.log("isAdmin "  + this.props.isAdmin);

        if(this.props.isAdmin){
                return <div>
                    <Navigation/>
                    <Container className="mt-5">
                        <Row>
                            <Col sm="12">
                                <SearchInput className="mt-4 search-input form-control " caseSensitive={true} placeholder="Search.." onChange={this.searchUpdated} />

                                <CardGroup>
                                    { filteredAnimals.map(animal => {

                                        return (
                                            <div key={animal.id} >
                                                <Card width="100%" className="animal-card mt-3 ml-2 mb-2">
                                                    { animal.imageurl === noImage
                                                        ? noAnimalImage
                                                        :<CardImg className={ imageStyle + noAnimalImageStyle} top width="50%"
                                                                  src={ defaultImageUrl + animal.imageurl }
                                                                  alt="Card animal image cap"/>
                                                    }
                                                    <CardBody>
                                                        <CardTitle className="font-weight-bold"> { animal.name }</CardTitle>
                                                        <CardSubtitle> { animal.latinname }</CardSubtitle>
                                                        <CardText>Počet: {animal.count }</CardText>

                                                        <Button to={`/animals/${animal.id}/edit`}
                                                                tag={Link}
                                                                className="mr-2"
                                                                color="btn btn-success"
                                                                onClick={this.toggle}>Edit
                                                        </Button>
                                                        <Button onClick={(event) => this.onDeleteSubmit(event,  animal.id)} type="submit" color="danger">Delete</Button>

                                                    </CardBody>
                                                </Card>
                                            </div>
                                        )
                                    })
                                    }
                                </CardGroup>


                            </Col>
                        </Row>
                    </Container>
                    <Footer/>
                </div>
            }
            else{
            return <div>
                <Navigation logoutLink="true"/>
                <Container className="mt-5">
                    <Row>
                        <Col sm="12">
                            <SearchInput className="mt-2 search-input" exactMatch={true} onChange={this.searchUpdated} />
                            <CardColumns>
                                { filteredAnimals.map(animal => {
                                    return (
                                        <Card key={animal.id} className="animal-card mt-3 ml-2 mb-2">
                                            { animal.imageurl === noImage
                                                ? noAnimalImage
                                                :<CardImg className={ imageStyle + noAnimalImageStyle} top width="50%"
                                                          src={ defaultImageUrl + animal.imageurl }
                                                          alt="Card animal image cap"/>
                                            }
                                            <CardBody>
                                                <CardTitle className="font-weight-bold"> { animal.name }</CardTitle>
                                                <CardSubtitle> { animal.latinname }</CardSubtitle>
                                                <CardText>Count: {animal.count }</CardText>

                                            </CardBody>
                                        </Card>
                                    )
                                })
                                }
                            </CardColumns>
                        </Col>
                    </Row>
                </Container>
                <Footer/>
            </div>
            }
    }

}

export default withRouter(List);
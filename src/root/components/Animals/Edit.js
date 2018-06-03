import React, {Component} from 'react';
import { Link } from 'react-router-dom';
import Navigation from '../Common/Navigation';
import {Redirect } from 'react-router-dom';
import ajax from '../../utils/ajax';
import {
    Alert,
    Container,
    Button,
    Input
} from 'reactstrap';


class Edit extends Component {
    constructor(props) {
        super(props);

        this.state = {
            name: '',
            latinname: '',
            count: '',
            status: "LOADING",
            visibleErr: false
        };
    }

    componentDidMount(){
        console.log(this.props.match);
        ajax.get('/user/animals/' + this.props.match.params.id)
            .then(response => {
                this.setState({...response.data.daticka.animals, status: "OK"});
            })
            .catch(function (error) {
                console.log(error);

                if(error.response.status === 404){
                    this.setState({
                        status: "NOT_FOUND"
                    })
                }
            })
    }

    handleSubmit(event) {
        event.preventDefault();
        const animal = {
            name: this.state.name,
            latinname: this.state.latinname,
            count: this.state.count
        };



        animal.name !== '' &&  animal.latinname !== '' && animal.count !== ''
            ? this.sendDataToServer(animal)
            : this.setState({visibleErr: true});


    }

    sendDataToServer(animal){
        let uri = 'user/animals/'+  this.props.match.params.id ;

        ajax.patch(uri, animal).then((response) => {
            this.props.history.push('/animals');
        });
    }

    handleNameChange = (e) => {
        const {value} = e.target ;
        this.setState({name: value});
    };

    handleLatinnameChange = (e) => {
        const {value} = e.target ;
        this.setState({latinname: value});
    };

    handleCountChange = (e) => {
        const {value} = e.target ;
        this.setState({count: value});
    };

    render(){
        if(this.state.status === "LOADING"){
            return <div className="loading">Loading ...</div>
        }
        else if(this.state.status === "NOT_FOUND"){
            return <Redirect to={"/404"}/>
        }
        return (
            <div>
                <Navigation/>
                <Container className="container-customized">

                    <div className="row">
                        <div className="mt-7 col-md-2">
                            <Link to="/animals" className="btn btn-success">Zpět</Link>
                        </div>
                    </div>

                    <h2 className="mt-2" >Update Animal</h2>
                    <br />

                    <Input name="name"
                           placeholder="Name .."
                           type="text"
                           className="form-control"
                           value={this.state.name}
                           onChange={this.handleNameChange}
                           minLength={10}
                    />
                    <br />
                    <Input name="latinname"
                           placeholder="Latin name .."
                           type="text"
                           className="form-control"
                           value={this.state.latinname}
                           onChange={this.handleLatinnameChange}
                           minLength={10}
                    />
                    <br />
                    <Input name="count"
                           placeholder="Count .."
                           type="number"
                           className="form-control"
                           value={this.state.count}
                           validate={{number: true}}
                           onChange={this.handleCountChange}
                    />
                    <br />

                    <Button onClick={(event) => this.handleSubmit(event)} type="submit" color="success">Update</Button>

                    <br />
                    { this.state.visibleErr &&
                    <Alert color="danger" isOpen={this.state.visibleErr} toggle={this.onDismiss}>
                        Please fill all information about animal !
                    </Alert>
                    }


                </Container>
            </div>
        )
    }
}
export default Edit;
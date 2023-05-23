import Head from 'next/head'
import Container from 'react-bootstrap/Container';
import Navbar from 'react-bootstrap/Navbar';
import Nav from 'react-bootstrap/Nav';

function BrandExample() {
    return (
        <header>
            <Head>
                <title>NEXT_APP</title>
                <meta name="viewport" content="initial-scale=1.0, width=device-width" />
                <link rel="apple-touch-icon" sizes="180x180" href="/icon.png"/>
            </Head>
            <Navbar bg="dark" variant="dark">
                <Container>
                    <Navbar.Brand href="#home">
                        <img
                            alt=""
                            src="/logo.svg"
                            width="30"
                            height="30"
                            className="d-inline-block align-top"
                        />
                        NEXT_APP
                    </Navbar.Brand>
                    <Nav className="me-auto">
                        <Nav.Link href="\">Home</Nav.Link>
                        <Nav.Link href="\log">Features</Nav.Link>
                        <Nav.Link href="\about">Pricing</Nav.Link>
                    </Nav>
                </Container>
            </Navbar>
        </header>
    );
}

export default BrandExample;
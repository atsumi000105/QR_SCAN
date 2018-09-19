import React, { Component } from 'react'
import { View,Text,StyleSheet,Alert,TouchableOpacity,Linking,NetInfo } from "react-native";
import QRCodeScanner from 'react-native-qrcode-scanner';

export default class CameraScreen extends Component {
    static navigationOptions ={
        title:"Scan Barcode Tiket"
    }
  state = {
    isConnected: true
  }  ;
    componentDidMount(){
      NetInfo.isConnected.addEventListener('connectionChange ',this.handleConnection);
    }
    componentWillMount(){
      NetInfo.isConnected.addEventListener('connectionChange ',this.handleConnection);

    }
    handleConnection(isConnected){
      if(isConnected){
        this.setState({isConnected});
      }
      else{
        this.setState({isConnected});


      }
    }
    read(e){
        console.log(e);
        Alert.alert("ok");
    }
    offline() {
      return(
        
    <View style={styles.offlineContainer}>
    <Text style={styles.offlineText}>No Internet Connection</Text>
</View>
      )
    }
    onSuccess(e) {


      //aksi anda
      // console.log(e);
      const qr = e.data;
      fetch(url).then(res => res.json())
      .then(res=>{
        // console.log(res);
        if(res.status=="ok"){
          const data = res.data;
          this.props.navigation.navigate('Detail',{
            qr,
            data
          });
              
        }
        else{
          Alert.alert("Tidak Ada Data");
          this.scanner.reactivate();
        }
      });
      // this.props.navigation.navigate('Detail',{
      //   qr
      // });
        // Linking
        //   .openURL(e.data)
        //   .catch(err => console.error('An error occured', err));
      }
    
  render() {
    

      if(!this.state.isConnected){
        this.offline();
      }
      
    return (
      <QRCodeScanner        
      reactivate={true}
        onRead={this.onSuccess.bind(this)}
        ref={(node) => { this.scanner = node }}
          topContent={
            <Text style={styles.centerText}>
            Arahkan Kamera ke Barcode 
            </Text>
          }

        />
    )
  }
}

const styles = StyleSheet.create({
    centerText: {
      flex: 1,
      fontSize: 18,
      padding: 32,
      color: '#777',
    },
    textBold: {
      fontWeight: '500',
      color: '#000',
    },
    buttonText: {
      fontSize: 21,
      color: 'rgb(0,122,255)',
    },
    buttonTouchable: {
      padding: 16,
    },
    offlineText: { color: '#fff' },
    offlineContainer: {
      backgroundColor: '#b52424',
      height: 30,
      justifyContent: 'center',
      alignItems: 'center',
      flexDirection: 'row',
      position: 'absolute',
      top: 30
  },
  });
  
<%@ Page Language="C#" MasterPageFile="~/SealifeProtection.master" Title="welcome"  Theme="SkinFile" %>

<asp:Content ID="mainContent" ContentPlaceHolderID="ContentPlaceHolder1" runat="Server">
    <table class="tablecontent">
        <tr>
            <td>
                <div class="border2">
                    <div class="firstLetterBig">
                   <p> Our vision is of a world where our oceans are healthy, 
            properly protected and full of diverse life.In order to build this sea life world,
            we run inspiring conservation campaigns and fund projects and education programmes that 
                    champion the need for plastic-free oceans,
            sustainable fishing, effective Marine Protected Areas and an end to over-exploitation of marine life.
                </p></div></div>
            </td>
            <td>
                <div class="border1">
                    What we do:<p />
                    1. Combating Overfishing<p />
                    2. Coastal Cleanup<p />
                    3. reject Marine Life products<p />
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div>
                    <asp:AdRotator runat="server" CssClass="ad" AdvertisementFile="ad.xml" Target="_blank" />
                </div>
            </td>
            <td>
                <div class="border2">
                    <asp:HyperLink ID="hl1" runat="server"
                        NavigateUrl="mailto:yzha735@student.monash.edu" Text="&diams;&nbsp;&nbsp;Author Email" /><br />
                    <asp:HyperLink ID="HyperLink1" runat="server"
                        NavigateUrl="PersonalDisclaimer.aspx" Text="&diams;&nbsp;&nbsp;Personal Disclaimer" /><br />
                    <asp:HyperLink ID="HyperLink2" runat="server"
                        NavigateUrl="http://www.monash.edu/disclaimer-copyright" 
                        Text="&diams;&nbsp;&nbsp;standard Monash disclaimer" /><br />
                    <asp:HyperLink ID="HyperLink3" runat="server"
                        NavigateUrl="CopyrightNotice.aspx" Text="&diams;&nbsp;&nbsp;copyright notice" /><br />
                    <asp:HyperLink ID="HyperLink4" runat="server"
                        NavigateUrl="Acknowledgement.aspx" Text="&diams;&nbsp;&nbsp;acknowledgements" /><br />
                </div>
            </td>
        </tr>
    </table>
</asp:Content>

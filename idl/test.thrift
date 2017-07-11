
namespace * service.test




/** 消息包头,用于所有外部请求包 */
struct MsgHeader
{
    /** 商户号 */
    1:    string merchantId(go.tag="hsKey:\"merid\" valid:\"required~商户号不能为空\"");
    /** 请求的功能编号, function字段是关键字 */
    2:    string functionId(go.tag="hsKey:\"function\" valid:\"required~功能号不能为空\"");
    /** 业务跟踪码 */
    3:    string traceId;
    /** 数据包签名值 */
    4:    string signMsg(go.tag="hsKey:\"signmsg\" valid:\"required~签名信息不能为空\"");
    /** 登录后进行分配，后续需要带上 */
    5:    string sessionKey(go.tag="hsKey:\"sessionkey\"");
    /** 返回码0表示正常 */
    6:    i32 retCode;
    /** 返回描述 */
    7:    string retMsg;
    /**委托方式 (0:柜台委托 2:网上委托 4:传真委托 ) */
    8:    string  custTrust = "2" (go.tag="hsKey:\"custtrust\"");
    /** 交易来源 (采用恒生目前分配的数值 财富派:000000520006 方舟:待确认 微诺亚:待确认 CRM:待确认 柜台:待确认   默认0000表示未知 ) */
    9:    string tradeSource = "0000";
	/** 交易网点 */
	10:   string netNo;
	/** 操作员/复核员 */
	11:   string operatorNo;

}

struct Pagination
{
    /** 每页数量 */
    1:  i32 pageSize;
    /** 第几页 */
    2:  i32 pageIndex;
    /** 总共页数 */
    3:  i32 pageCount;
    /** 总过记录数 */
    4:  i32 recordCount;
}

struct testReq
{
    1:    MsgHeader header;
    /** 外部流水号 */
    2:    string outsideSerialNo;
    /** 交易账号 */
    3:    string accountId;
    /** 基金账号 */
    4:    string fundCode;
    /** 业务代码 */
    5:    string businFlag;
    /** 收费方式 */
    6:    string shareType;
    /** 交易金额或份额 */
    7:    i64 applySumE2;
}

struct TestResp
{
	1:string name;
	2:i32 age;
}
